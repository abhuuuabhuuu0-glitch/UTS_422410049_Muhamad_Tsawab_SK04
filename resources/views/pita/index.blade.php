@extends('layouts.app')
@section('title', 'Koleksi Pita')
@section('content')
<x-page-header title="Koleksi Pita Analog" subtitle="Telusuri, saring, dan kelola arsip pita." icon="bi-collection-play">
    <a href="{{ route('pita.create') }}" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Tambah Pita</a>
</x-page-header>

<div class="card glass-card mb-3 filter-card">
    <div class="card-body">
        <form method="GET" action="{{ route('pita.index') }}" id="pitaFilter" data-live-form data-results="#pita-results">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 search-box">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control ps-5"
                           placeholder="Cari judul, kode arsip, atau lokasi..." data-live-search autocomplete="off">
                    <span class="search-spinner d-none" data-search-spinner></span>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Kategori</label>
                    <select name="kategori_id" class="form-select" data-auto-submit>
                        <option value="">Semua kategori</option>
                        @foreach ($kategoriList as $k)
                            <option value="{{ $k->id }}" @selected(request('kategori_id') == $k->id)>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Kondisi</label>
                    <select name="kondisi" class="form-select" data-auto-submit>
                        <option value="">Semua kondisi</option>
                        @foreach ($kondisiList as $key => $label)
                            <option value="{{ $key }}" @selected(request('kondisi') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Urutkan</label>
                    <select name="urut" class="form-select" data-auto-submit>
                        <option value="">Terbaru ditambahkan</option>
                        <option value="judul" @selected(request('urut') === 'judul')>Judul</option>
                        <option value="tahun" @selected(request('urut') === 'tahun')>Tahun rekaman</option>
                        <option value="kondisi" @selected(request('urut') === 'kondisi')>Kondisi</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2 d-flex gap-2">
                    <a href="{{ route('pita.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label small fw-semibold d-block mb-2"><i class="bi bi-exclamation-triangle text-amber"></i> Filter kerusakan <span class="text-muted">(pilih lebih dari satu)</span></label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($kerusakanList as $kr)
                        <x-chip name="kerusakan[]" :value="$kr->id" :label="$kr->nama"
                                :checked="in_array($kr->id, (array) request('kerusakan', []))" data-auto-submit />
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>

<div id="pita-results">
    @include('pita.partials.table')
</div>
@endsection
