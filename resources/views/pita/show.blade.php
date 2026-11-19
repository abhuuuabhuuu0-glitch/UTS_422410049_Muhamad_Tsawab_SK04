@extends('layouts.app')
@section('title', 'Detail Pita')
@section('content')
<x-page-header :title="$pita->judul" :subtitle="'Kode arsip '.$pita->kode_arsip" icon="bi-disc">
    <a href="{{ route('pita.edit', $pita) }}" class="btn btn-amber"><i class="bi bi-pencil"></i> Ubah</a>
    <x-delete-form :action="route('pita.destroy', $pita)" :message="'Hapus pita '.$pita->judul.'?'" label="Hapus" />
</x-page-header>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <div class="reel-visual mb-4">
                <div class="reel-spin"><i class="bi bi-disc"></i></div>
                <div>
                    <h2 class="h5 fw-bold mb-1">{{ $pita->kategori->nama }}</h2>
                    <x-kondisi-badge :kondisi="$pita->kondisi" />
                </div>
            </div>
            <dl class="row mb-0 detail-list">
                <dt class="col-sm-4">Tahun rekaman</dt><dd class="col-sm-8">{{ $pita->tahun_rekaman ?? '—' }}</dd>
                <dt class="col-sm-4">Durasi</dt><dd class="col-sm-8">{{ $pita->durasi_menit ? $pita->durasi_menit.' menit' : '—' }}</dd>
                <dt class="col-sm-4">Lokasi simpan</dt><dd class="col-sm-8">{{ $pita->lokasi_simpan ?? '—' }}</dd>
                <dt class="col-sm-4">Deskripsi</dt><dd class="col-sm-8">{{ $pita->deskripsi ?? '—' }}</dd>
            </dl>
            <h3 class="h6 fw-bold mt-4 mb-2">Kerusakan Tercatat</h3>
            <div class="d-flex flex-wrap gap-2">
                @forelse ($pita->kerusakan as $kr)
                    <span class="mini-tag"><i class="bi bi-bug me-1"></i>{{ $kr->nama }}</span>
                @empty
                    <span class="text-muted small">Tidak ada kerusakan tercatat — kondisi terjaga.</span>
                @endforelse
            </div>
        </div></div>
    </div>

    <div class="col-lg-5">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-tools text-amber me-2"></i>Riwayat Restorasi</h2>
                <a href="{{ route('restorasi.create') }}" class="btn btn-sm btn-amber-outline">+ Proyek</a>
            </div>
            @forelse ($pita->restorasi->sortByDesc('tanggal_mulai') as $r)
                <a href="{{ route('restorasi.show', $r) }}" class="history-item d-flex justify-content-between align-items-center text-decoration-none mb-2">
                    <div>
                        <div class="fw-semibold text-body">{{ $r->tanggal_mulai->format('d M Y') }}</div>
                        <small class="text-muted">{{ $r->teknisi->nama ?? 'Tanpa teknisi' }}</small>
                    </div>
                    <x-status-badge :status="$r->status" />
                </a>
            @empty
                <x-empty-state message="Pita ini belum pernah direstorasi." />
            @endforelse
        </div></div>
    </div>
</div>
@endsection
