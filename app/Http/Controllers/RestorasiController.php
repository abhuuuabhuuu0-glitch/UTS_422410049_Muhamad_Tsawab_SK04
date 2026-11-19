<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestorasiRequest;
use App\Models\Peralatan;
use App\Models\Pita;
use App\Models\Restorasi;
use App\Models\RestorasiDetail;
use App\Models\Teknisi;
use App\Services\RestorasiService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RestorasiController extends Controller
{
    public function __construct(private readonly RestorasiService $service)
    {
    }

    public function index(Request $request): View|JsonResponse
    {
        $restorasiList = Restorasi::query()
            ->with(['pita.kategori', 'teknisi', 'peralatan'])
            ->withCount('detail')
            ->cari($request->string('q')->trim()->value())
            ->filterStatus($request->input('status'))
            ->filterTeknisi($request->integer('teknisi_id') ?: null)
            ->filterPeralatan(array_map('intval', (array) $request->input('peralatan', [])))
            ->when($request->filled('dari'), fn ($q) => $q->whereDate('tanggal_mulai', '>=', $request->input('dari')))
            ->when($request->filled('sampai'), fn ($q) => $q->whereDate('tanggal_mulai', '<=', $request->input('sampai')))
            ->latest('tanggal_mulai')
            ->paginate(10)
            ->withQueryString();

        $data = [
            'restorasiList' => $restorasiList,
            'teknisiList' => Teknisi::orderBy('nama')->get(),
            'peralatanList' => Peralatan::orderBy('nama')->get(),
            'statusList' => Restorasi::STATUS,
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('restorasi.partials.table', $data)->render(),
                'total' => $restorasiList->total(),
            ]);
        }

        return view('restorasi.index', $data);
    }

    public function create(): View
    {
        return view('restorasi.create', $this->formData(new Restorasi(['status' => 'menunggu', 'tanggal_mulai' => now()])));
    }

    public function store(RestorasiRequest $request): RedirectResponse
    {
        $restorasi = $this->service->create(
            $request->safe()->except('peralatan_ids'),
            $request->validated('peralatan_ids', []),
        );

        return redirect()->route('restorasi.show', $restorasi)
            ->with('success', 'Proyek restorasi berhasil dibuat.');
    }

    public function show(Restorasi $restorasi): View
    {
        $restorasi->load(['pita.kategori', 'teknisi', 'peralatan', 'detail']);

        return view('restorasi.show', [
            'restorasi' => $restorasi,
            'tahapList' => RestorasiDetail::TAHAP,
            'statusList' => Restorasi::STATUS,
        ]);
    }

    public function edit(Restorasi $restorasi): View
    {
        return view('restorasi.edit', $this->formData($restorasi));
    }

    public function update(RestorasiRequest $request, Restorasi $restorasi): RedirectResponse
    {
        $this->service->update(
            $restorasi,
            $request->safe()->except('peralatan_ids'),
            $request->validated('peralatan_ids', []),
        );

        return redirect()->route('restorasi.show', $restorasi)->with('success', 'Proyek restorasi diperbarui.');
    }

    /** Perubahan status cepat (tombol di halaman detail). */
    public function updateStatus(Request $request, Restorasi $restorasi): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(Restorasi::STATUS))],
        ]);

        $this->service->ubahStatus($restorasi, $validated['status']);

        return back()->with('success', 'Status diubah menjadi "'.Restorasi::STATUS[$validated['status']].'".');
    }

    public function destroy(Restorasi $restorasi): RedirectResponse
    {
        $this->service->delete($restorasi);

        return redirect()->route('restorasi.index')->with('success', 'Proyek restorasi berhasil dihapus.');
    }

    private function formData(Restorasi $restorasi): array
    {
        return [
            'restorasi' => $restorasi,
            'pitaList' => Pita::with('kategori')->orderBy('judul')->get(),
            'teknisiList' => Teknisi::orderBy('nama')->get(),
            'peralatanList' => Peralatan::orderBy('jenis')->orderBy('nama')->get(),
            'statusList' => Restorasi::STATUS,
            'peralatanTerpilih' => $restorasi->exists ? $restorasi->peralatan->pluck('id')->all() : [],
        ];
    }
}
