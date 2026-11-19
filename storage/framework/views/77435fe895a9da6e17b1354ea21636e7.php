<?php $__env->startSection('title', 'Proyek Restorasi'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Proyek Restorasi','subtitle' => 'Kelola proses restorasi dari pembersihan hingga verifikasi.','icon' => 'bi-tools']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Proyek Restorasi','subtitle' => 'Kelola proses restorasi dari pembersihan hingga verifikasi.','icon' => 'bi-tools']); ?>
    <a href="<?php echo e(route('restorasi.create')); ?>" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Proyek Baru</a>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

<div class="card glass-card mb-3 filter-card">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('restorasi.index')); ?>" data-live-form data-results="#restorasi-results">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 search-box">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" value="<?php echo e(request('q')); ?>" class="form-control ps-5" placeholder="Cari judul atau kode arsip..." data-live-search autocomplete="off">
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select" data-auto-submit>
                        <option value="">Semua status</option>
                        <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php if(request('status') === $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Teknisi</label>
                    <select name="teknisi_id" class="form-select" data-auto-submit>
                        <option value="">Semua teknisi</option>
                        <?php $__currentLoopData = $teknisiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t->id); ?>" <?php if(request('teknisi_id') == $t->id): echo 'selected'; endif; ?>><?php echo e($t->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Mulai dari</label>
                    <input type="date" name="dari" value="<?php echo e(request('dari')); ?>" class="form-control" data-auto-submit>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Sampai</label>
                    <input type="date" name="sampai" value="<?php echo e(request('sampai')); ?>" class="form-control" data-auto-submit>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label small fw-semibold d-block mb-2"><i class="bi bi-wrench-adjustable text-amber"></i> Filter peralatan <span class="text-muted">(pilihan jamak)</span></label>
                <div class="d-flex flex-wrap gap-2">
                    <?php $__currentLoopData = $peralatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3e43da63772e725970863e9067088b49 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e43da63772e725970863e9067088b49 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chip','data' => ['name' => 'peralatan[]','value' => $p->id,'label' => $p->nama,'checked' => in_array($p->id, (array) request('peralatan', [])),'dataAutoSubmit' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'peralatan[]','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($p->id),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($p->nama),'checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(in_array($p->id, (array) request('peralatan', []))),'data-auto-submit' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e43da63772e725970863e9067088b49)): ?>
<?php $attributes = $__attributesOriginal3e43da63772e725970863e9067088b49; ?>
<?php unset($__attributesOriginal3e43da63772e725970863e9067088b49); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e43da63772e725970863e9067088b49)): ?>
<?php $component = $__componentOriginal3e43da63772e725970863e9067088b49; ?>
<?php unset($__componentOriginal3e43da63772e725970863e9067088b49); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="restorasi-results">
    <?php echo $__env->make('restorasi.partials.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/restorasi/index.blade.php ENDPATH**/ ?>