<?php

namespace App\Http\Controllers;

use App\Http\Requests\PitaRequest;
use App\Models\Kerusakan;
use App\Models\KategoriPita;
use App\Models\Pita;
use App\Services\PitaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PitaController extends Controller
{
    public function __construct(private readonly PitaService $service)
    {
    }

    public function index(Request $request): View|JsonResponse
    {
        $pitaList = $this->filteredQuery($request)
            ->with(['kategori', 'kerusakan'])
            ->orderBy($this->sortColumn($request), $request->input('arah') === 'asc' ? 'asc' : 'desc')
            ->paginate(10)
            ->withQueryString();

        $data = [
            'pitaList' => $pitaList,
            'kategoriList' => KategoriPita::orderBy('nama')->get(),
            'kerusakanList' => Kerusakan::orderBy('nama')->get(),
            'kondisiList' => Pita::KONDISI,
        ];

        // Dipanggil oleh pencarian langsung (AJAX) agar hanya tabel yang diperbarui.
        if ($request->ajax()) {
            return response()->json([
                'html' => view('pita.partials.table', $data)->render(),
                'total' => $pitaList->total(),
            ]);
        }

        return view('pita.index', $data);
    }

    public function create(): View
    {
        return view('pita.create', $this->formData(new Pita()));
    }

    public function store(PitaRequest $request): RedirectResponse
    {
        $pita = $this->service->create(
            $request->safe()->except('kerusakan_ids'),
            $request->validated('kerusakan_ids', []),
        );

        return redirect()->route('pita.show', $pita)->with('success', 'Pita "'.$pita->judul.'" berhasil ditambahkan.');
    }

    public function show(Pita $pita): View
    {
        $pita->load(['kategori', 'kerusakan', 'restorasi.teknisi']);

        return view('pita.show', ['pita' => $pita]);
    }

    public function edit(Pita $pita): View
    {
        return view('pita.edit', $this->formData($pita));
    }

    public function update(PitaRequest $request, Pita $pita): RedirectResponse
    {
        $this->service->update(
            $pita,
            $request->safe()->except('kerusakan_ids'),
            $request->validated('kerusakan_ids', []),
        );

        return redirect()->route('pita.show', $pita)->with('success', 'Data pita berhasil diperbarui.');
    }

    public function destroy(Pita $pita): RedirectResponse
    {
        $this->service->delete($pita);

        return redirect()->route('pita.index')->with('success', 'Pita berhasil dihapus.');
    }

    private function filteredQuery(Request $request)
    {
        return Pita::query()
            ->cari($request->string('q')->trim()->value())
            ->filterKategori($request->integer('kategori_id') ?: null)
            ->filterKondisi($request->input('kondisi'))
            ->filterKerusakan(array_map('intval', (array) $request->input('kerusakan', [])));
    }

    private function sortColumn(Request $request): string
    {
        return match ($request->input('urut')) {
            'judul' => 'judul',
            'tahun' => 'tahun_rekaman',
            'kondisi' => 'kondisi',
            default => 'created_at',
        };
    }

    private function formData(Pita $pita): array
    {
        return [
            'pita' => $pita,
            'kategoriList' => KategoriPita::orderBy('nama')->get(),
            'kerusakanList' => Kerusakan::orderBy('nama')->get(),
            'kondisiList' => Pita::KONDISI,
            'kerusakanTerpilih' => $pita->exists ? $pita->kerusakan->pluck('id')->all() : [],
        ];
    }
}
