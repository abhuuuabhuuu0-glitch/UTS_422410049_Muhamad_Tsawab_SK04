@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<x-page-header title="Ringkasan Arsip Pita Analog" subtitle="Pantau koleksi dan proyek restorasi secara real-time." icon="bi-speedometer2" />

<div class="row g-3 mb-4">
    <div class="col-6 col-xl"><x-stat-card icon="bi-disc" label="Total Pita" :value="$statistik['pita']" tone="amber" /></div>
    <div class="col-6 col-xl"><x-stat-card icon="bi-arrow-repeat" label="Restorasi Aktif" :value="$statistik['restorasi_aktif']" tone="blue" /></div>
    <div class="col-6 col-xl"><x-stat-card icon="bi-check2-circle" label="Selesai" :value="$statistik['selesai']" tone="green" /></div>
    <div class="col-6 col-xl"><x-stat-card icon="bi-people" label="Teknisi" :value="$statistik['teknisi']" tone="violet" /></div>
    <div class="col-12 col-xl">
        <div class="stat-card tone-rose h-100">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div>
                <div class="stat-label">Biaya Selesai</div>
                <div class="stat-value fs-5">Rp {{ number_format($statistik['total_biaya'], 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-5">
        <div class="card glass-card h-100">
            <div class="card-body">
                <h2 class="h6 fw-bold mb-3"><i class="bi bi-pie-chart-fill text-amber me-2"></i>Koleksi per Kategori</h2>
                <canvas id="chartKategori" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card glass-card h-100">
            <div class="card-body">
                <h2 class="h6 fw-bold mb-3"><i class="bi bi-bar-chart-fill text-amber me-2"></i>Status Proyek Restorasi</h2>
                <canvas id="chartStatus" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card glass-card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 fw-bold mb-0"><i class="bi bi-clock-history text-amber me-2"></i>Restorasi Terbaru</h2>
            <a href="{{ route('restorasi.index') }}" class="small">Lihat semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>Pita</th><th>Teknisi</th><th>Mulai</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($terbaru as $r)
                    <tr>
                        <td><div class="fw-semibold">{{ $r->pita->judul }}</div><small class="text-muted">{{ $r->pita->kode_arsip }}</small></td>
                        <td>{{ $r->teknisi->nama ?? '—' }}</td>
                        <td>{{ $r->tanggal_mulai->format("d M Y") }}</td>
                        <td><x-status-badge :status="$r->status" /></td>
                        <td class="text-end"><a href="{{ route('restorasi.show', $r) }}" class="btn btn-sm btn-amber-outline">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state message="Belum ada proyek restorasi." /></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.dashboardData = {
        kategori: {
            labels: @json($perKategori->pluck('nama')),
            data: @json($perKategori->pluck('pita_count')),
        },
        status: {
            labels: @json($perStatus->pluck('label')),
            data: @json($perStatus->pluck('jumlah')),
        },
    };
</script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    (function () {
        if (!window.Chart || !window.dashboardData) return;
        const pal = ['#e8a33d', '#c2410c', '#2563eb', '#16a34a', '#7c3aed', '#db2777', '#0891b2'];
        const dark = document.documentElement.dataset.bsTheme === 'dark';
        const text = dark ? '#f5e6cc' : '#3b2415';
        Chart.defaults.color = text;
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        new Chart(document.getElementById('chartKategori'), {
            type: 'doughnut',
            data: { labels: window.dashboardData.kategori.labels,
                    datasets: [{ data: window.dashboardData.kategori.data, backgroundColor: pal, borderWidth: 0 }] },
            options: { plugins: { legend: { position: 'bottom' } }, cutout: '62%', animation: { animateRotate: true, duration: 1200 } }
        });
        new Chart(document.getElementById('chartStatus'), {
            type: 'bar',
            data: { labels: window.dashboardData.status.labels,
                    datasets: [{ label: 'Proyek', data: window.dashboardData.status.data, borderRadius: 10,
                                 backgroundColor: ['#f59e0b', '#2563eb', '#16a34a', '#64748b'] }] },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                       animation: { duration: 1000 } }
        });
    })();
</script>
@endpush
