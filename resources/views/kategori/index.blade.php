@extends('layouts.app')
@section('title', 'Kategori Pita')
@section('content')
<x-page-header title="Kategori Pita" subtitle="Jenis media analog yang dikelola dalam arsip." icon="bi-tags">
    <a href="{{ route('kategori.create') }}" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Kategori Baru</a>
</x-page-header>

<div class="card glass-card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-center" data-live-form>
            <div class="col-md-6 col-lg-4 search-box">
                <i class="bi bi-search"></i>
                <input type="search" name="q" value="{{ request('q') }}" class="form-control ps-5" placeholder="Cari nama kategori..." data-live-search>
            </div>
        </form>
    </div>
</div>

<div class="row g-3">
    @forelse ($kategori as $k)
        <div class="col-md-6 col-xl-4">
            <div class="card glass-card h-100 hover-lift">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="category-badge"><i class="bi bi-disc-fill"></i></span>
                        <span class="badge rounded-pill badge-soft badge-primary">{{ $k->pita_count }} pita</span>
                    </div>
                    <h2 class="h5 fw-bold mb-1">{{ $k->nama }}</h2>
                    <p class="text-muted small flex-grow-1">{{ $k->deskripsi ?: 'Tanpa deskripsi.' }}</p>
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route('kategori.edit', $k) }}" class="btn btn-sm btn-amber-outline"><i class="bi bi-pencil"></i> Ubah</a>
                        <x-delete-form :action="route('kategori.destroy', $k)" :message="'Hapus kategori '.$k->nama.'?'" :small="true" />
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="card glass-card"><div class="card-body"><x-empty-state message="Kategori tidak ditemukan." /></div></div></div>
    @endforelse
</div>
<div class="mt-3">{{ $kategori->links() }}</div>
@endsection
