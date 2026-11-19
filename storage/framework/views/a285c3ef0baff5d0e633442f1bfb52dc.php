<aside class="sidebar d-flex flex-column p-3" id="sidebar">
    <a href="<?php echo e(route('dashboard')); ?>" class="brand d-flex align-items-center gap-2 mb-4 text-decoration-none">
        <span class="reel-icon"><i class="bi bi-disc"></i></span>
        <span>
            <span class="brand-title d-block">Restorasi</span>
            <span class="brand-sub d-block">Pita Analog · SK04</span>
        </span>
    </a>

    <?php
        $menu = [
            ['route' => 'dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'match' => 'dashboard'],
            ['route' => 'pita.index', 'icon' => 'bi-collection-play', 'label' => 'Koleksi Pita', 'match' => 'pita.*'],
            ['route' => 'restorasi.index', 'icon' => 'bi-tools', 'label' => 'Proyek Restorasi', 'match' => 'restorasi.*'],
            ['route' => 'kategori.index', 'icon' => 'bi-tags', 'label' => 'Kategori Pita', 'match' => 'kategori.*'],
        ];
    ?>

    <nav class="nav flex-column gap-1">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route($item['route'])); ?>"
               class="nav-link sidebar-link <?php echo e(request()->routeIs($item['match']) ? 'active' : ''); ?>">
                <i class="bi <?php echo e($item['icon']); ?>"></i>
                <span><?php echo e($item['label']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>