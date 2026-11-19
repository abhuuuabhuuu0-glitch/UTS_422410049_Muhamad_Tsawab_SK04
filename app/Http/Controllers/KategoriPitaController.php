<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriPitaRequest;
use App\Models\KategoriPita;
use App\Services\KategoriPitaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class KategoriPitaController extends Controller
{
    public function __construct(private readonly KategoriPitaService $service)
    {
    }

    public function index(Request $request): View
    {
        $kategori = KategoriPita::withCount('pita')
            ->when($request->string('q')->trim()->value(), fn ($q, $k) => $q->where('nama', 'like', "%{$k}%"))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('kategori'));
    }

    public function create(): View
    {
        return view('kategori.create', ['kategori' => new KategoriPita()]);
    }

    public function store(KategoriPitaRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori pita berhasil ditambahkan.');
    }

    public function edit(KategoriPita $kategoriPita): View
    {
        return view('kategori.edit', ['kategori' => $kategoriPita]);
    }

    public function update(KategoriPitaRequest $request, KategoriPita $kategoriPita): RedirectResponse
    {
        $this->service->update($kategoriPita, $request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori pita berhasil diperbarui.');
    }

    public function destroy(KategoriPita $kategoriPita): RedirectResponse
    {
        $this->service->delete($kategoriPita);

        return redirect()->route('kategori.index')->with('success', 'Kategori pita berhasil dihapus.');
    }
}
