@extends('layouts.app')
@section('title', 'Proyek Restorasi')
@section('content')
<x-page-header title="Proyek Restorasi" subtitle="Kelola proses restorasi dari pembersihan hingga verifikasi." icon="bi-tools">
    <a href="{{ route('restorasi.create') }}" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Proyek Baru</a>
</x-page-header>

<div class="card glass-card mb-3 filter-card">
    <div class="card-body">
        <form method="GET" action="{{ route('restorasi.index') }}" data-live-form data-results="#restorasi-results">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 search-box">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control ps-5" placeholder="Cari judul atau kode arsip..." data-live-search autocomplete="off">
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select" data-auto-submit>
                        <option value="">Semua status</option>
                        @foreach ($statusList as $key => $label)
                            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Teknisi</label>
                    <select name="teknisi_id" class="form-select" data-auto-submit>
                        <option value="">Semua teknisi</option>
                        @foreach ($teknisiList as $t)
                            <option value="{{ $t->id }}" @selected(request('teknisi_id') == $t->id)>{{ $t->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Mulai dari</label>
                    <input type="date" name="dari" value="{{ request('dari') }}" class="form-control" data-auto-submit>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Sampai</label>
                    <input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control" data-auto-submit>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label small fw-semibold d-block mb-2"><i class="bi bi-wrench-adjustable text-amber"></i> Filter peralatan <span class="text-muted">(pilihan jamak)</span></label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($peralatanList as $p)
                        <x-chip name="peralatan[]" :value="$p->id" :label="$p->nama"
                                :checked="in_array($p->id, (array) request('peralatan', []))" data-auto-submit />
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>

<div id="restorasi-results">
    @include('restorasi.partials.table')
</div>
@endsection
