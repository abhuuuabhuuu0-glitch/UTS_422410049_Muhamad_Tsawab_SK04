<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> · Restorasi Pita Analog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body class="app-body">
    <div class="reel-bg" aria-hidden="true"></div>

    <div class="d-flex app-shell">
        <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-grow-1 main-col">
            <header class="topbar d-flex align-items-center justify-content-between px-4 py-3">
                <button class="btn btn-sm btn-amber-outline d-lg-none" type="button" data-sidebar-toggle>
                    <i class="bi bi-list"></i>
                </button>
                <div class="d-none d-md-flex align-items-center gap-2 text-muted small">
                    <i class="bi bi-clock-history"></i>
                    <span id="live-clock">--:--:--</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-amber-outline" type="button" id="theme-toggle" title="Ganti tema">
                        <i class="bi bi-moon-stars"></i>
                    </button>
                    <a href="<?php echo e(route('pita.create')); ?>" class="btn btn-sm btn-amber"><i class="bi bi-plus-lg"></i> Pita Baru</a>
                </div>
            </header>

            <main class="container-fluid px-4 py-4">
                <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <footer class="text-center small text-muted py-4">
                SK04 · Restorasi Pita Analog · Laravel 12 &amp; MySQL
            </footer>
        </div>
    </div>

    <?php echo $__env->make('partials.confirm-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('partials.toast-container', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/layouts/app.blade.php ENDPATH**/ ?>