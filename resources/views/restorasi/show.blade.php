@extends('layouts.app')
@section('title', 'Detail Restorasi')
@section('content')
@php
    $pita = $restorasi->pita;
    $totalMenit = $restorasi->detail->sum('durasi_menit');
    $jam = intdiv($totalMenit, 60);
    $sisa = $totalMenit % 60;
@endphp

<x-page-header :title="$pita->judul" :subtitle="'Kode '.$pita->kode_arsip.' · '.$pita->kategori->nama" icon="bi-tools">
    <a href="{{ route('restorasi.edit', $restorasi) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil"></i> Ubah</a>
    <x-delete-form :action="route('restorasi.destroy', $restorasi)" message="Hapus proyek ini beserta seluruh tahapannya?" label="Hapus" />
</x-page-header>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">Status saat ini</span>
                <x-status-badge :status="$restorasi->status" />
            </div>
            <div class="reel-progress mb-3" data-progress="{{ $restorasi->status === 'selesai' ? 100 : ($restorasi->detail->count() ? min(95, $restorasi->detail->count() * 20) : 0) }}">
                <div class="reel-progress-bar"></div>
            </div>
            <p class="small text-muted mb-3">Perbarui status dengan satu klik:</p>
            <div class="d-grid gap-2 status-actions">
                @foreach ($statusList as $key => $label)
                    <form method="POST" action="{{ route('restorasi.status', $restorasi) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $key }}">
                        <button type="submit" class="btn btn-sm w-100 text-start {{ $restorasi->status === $key ? 'btn-amber' : 'btn-outline-secondary' }}" @disabled($restorasi->status === $key)>
                            {{ $label }} @if ($key === 'selesai')<small class="opacity-75">(pita → Baik)</small>@endif
                        </button>
                    </form>
                @endforeach
            </div>
        </div></div>
    </div>

    <div class="col-lg-8">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <div class="row g-3">
                <div class="col-sm-6"><div class="info-tile"><i class="bi bi-person-badge"></i><div><small>Teknisi</small><strong>{{ $restorasi->teknisi->nama ?? 'Belum ditugaskan' }}</strong></div></div></div>
                <div class="col-sm-6"><div class="info-tile"><i class="bi bi-calendar-range"></i><div><small>Periode</small><strong>{{ $restorasi->tanggal_mulai->format('d M Y') }} — {{ $restorasi->tanggal_selesai?->format('d M Y') ?? 'berjalan' }}</strong></div></div></div>
                <div class="col-sm-6"><div class="info-tile"><i class="bi bi-cash-coin"></i><div><small>Biaya</small><strong>Rp {{ number_format($restorasi->biaya, 0, ',', '.') }}</strong></div></div></div>
                <div class="col-sm-6"><div class="info-tile"><i class="bi bi-stopwatch"></i><div><small>Total Waktu Kerja</small><strong>{{ $jam }} jam {{ $sisa }} menit</strong></div></div></div>
                <div class="col-12">
                    <small class="text-muted d-block mb-2">Peralatan (pilihan jamak)</small>
                    @forelse ($restorasi->peralatan as $alat)
                        <span class="mini-tag"><i class="bi bi-cpu me-1"></i>{{ $alat->nama }}</span>
                    @empty
                        <span class="text-muted small">Belum ada peralatan dipilih.</span>
                    @endforelse
                </div>
                @if ($restorasi->catatan)
                    <div class="col-12"><div class="note-box">{{ $restorasi->catatan }}</div></div>
                @endif
            </div>
        </div></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card glass-card"><div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-list-task text-amber me-2"></i>Tahapan Restorasi <span class="badge rounded-pill badge-soft badge-primary ms-1">{{ $restorasi->detail->count() }}</span></h2>
            </div>

            <div class="timeline">
                @forelse ($restorasi->detail as $d)
                    <div class="timeline-item row-enter">
                        <span class="timeline-dot tahap-{{ $d->tahap }}"></span>
                        <div class="timeline-card">
                            <div class="d-flex flex-wrap justify-content-between gap-2">
                                <div>
                                    <span class="badge badge-soft badge-amber">{{ $d->tahap_label }}</span>
                                    <strong class="ms-1">{{ $d->tindakan }}</strong>
                                </div>
                                <div class="small text-muted"><i class="bi bi-calendar3"></i> {{ $d->tanggal->format('d M Y') }} · <i class="bi bi-stopwatch"></i> {{ $d->durasi_menit }} mnt</div>
                            </div>
                            @if ($d->hasil)<p class="small mb-2 mt-2 text-muted">{{ $d->hasil }}</p>@endif
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                        data-detail-edit
                                        data-action="{{ route('restorasi.detail.update', [$restorasi, $d]) }}"
                                        data-tahap="{{ $d->tahap }}"
                                        data-tindakan="{{ $d->tindakan }}"
                                        data-tanggal="{{ $d->tanggal->format('Y-m-d') }}"
                                        data-durasi="{{ $d->durasi_menit }}"
                                        data-hasil="{{ $d->hasil }}">
                                    <i class="bi bi-pencil"></i> Ubah
                                </button>
                                <x-delete-form :action="route('restorasi.detail.destroy', [$restorasi, $d])" message="Hapus tahap ini?" label="Hapus" :small="true" />
                            </div>
                        </div>
                    </div>
                @empty
                    <x-empty-state message="Belum ada tahapan. Tambahkan tahap pertama di panel samping." />
                @endforelse
            </div>
        </div></div>
    </div>

    <div class="col-xl-4">
        <div class="card glass-card sticky-top-lg"><div class="card-body p-4">
            <h2 class="h6 fw-bold mb-3"><i class="bi bi-plus-circle text-amber me-2"></i>Tambah Tahap</h2>
            <form method="POST" action="{{ route('restorasi.detail.store', $restorasi) }}" novalidate>
                @csrf
                @include('restorasi.partials.detail-fields', ['d' => null, 'tahapList' => $tahapList])
                <button type="submit" class="btn btn-amber w-100 mt-3"><i class="bi bi-plus-lg"></i> Tambah Tahap</button>
            </form>
        </div></div>
    </div>
</div>

{{-- Modal edit detail (diisi otomatis oleh JS dari tombol "Ubah") --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form method="POST" class="modal-content" id="detailEditForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square text-amber me-2"></i>Ubah Tahap Restorasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @include('restorasi.partials.detail-fields', ['d' => null, 'tahapList' => $tahapList, 'prefix' => 'modal'])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-amber"><i class="bi bi-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
