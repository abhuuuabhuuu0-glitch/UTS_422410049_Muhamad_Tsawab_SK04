<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" data-toast-message="<?php echo e(session('success')); ?>">
        <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>
<?php if(session('error') || $errors->has('pita') || $errors->has('kategori')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-octagon-fill me-2"></i>
        <?php echo e(session('error') ?? $errors->first('pita') ?? $errors->first('kategori')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/partials/flash.blade.php ENDPATH**/ ?>