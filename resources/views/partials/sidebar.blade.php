<aside class="sidebar d-flex flex-column p-3" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand d-flex align-items-center gap-2 mb-4 text-decoration-none">
        <span class="reel-icon"><i class="bi bi-disc"></i></span>
        <span>
            <span class="brand-title d-block">Restorasi</span>
            <span class="brand-sub d-block">Pita Analog · SK04</span>
        </span>
    </a>

    @php
        $menu = [
            ['route' => 'dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'match' => 'dashboard'],
            ['route' => 'pita.index', 'icon' => 'bi-collection-play', 'label' => 'Koleksi Pita', 'match' => 'pita.*'],
            ['route' => 'restorasi.index', 'icon' => 'bi-tools', 'label' => 'Proyek Restorasi', 'match' => 'restorasi.*'],
            ['route' => 'kategori.index', 'icon' => 'bi-tags', 'label' => 'Kategori Pita', 'match' => 'kategori.*'],
        ];
    @endphp

    <nav class="nav flex-column gap-1">
        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}"
               class="nav-link sidebar-link {{ request()->routeIs($item['match']) ? 'active' : '' }}">
                <i class="bi {{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto">
        <div class="tape-card p-3 small">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-lightning-charge-fill text-warning"></i>
                <strong>Tips</strong>
            </div>
            <span class="text-muted">Ketik di kolom pencarian untuk hasil langsung tanpa memuat ulang halaman.</span>
        </div>
    </div>
</aside>
