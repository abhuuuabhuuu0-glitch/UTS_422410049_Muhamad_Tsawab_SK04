<?php $__env->startSection('title', 'Koleksi Pita'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Koleksi Pita Analog','subtitle' => 'Telusuri, saring, dan kelola arsip pita.','icon' => 'bi-collection-play']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Koleksi Pita Analog','subtitle' => 'Telusuri, saring, dan kelola arsip pita.','icon' => 'bi-collection-play']); ?>
    <a href="<?php echo e(route('pita.create')); ?>" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Tambah Pita</a>
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
        <form method="GET" action="<?php echo e(route('pita.index')); ?>" id="pitaFilter" data-live-form data-results="#pita-results">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 search-box">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" value="<?php echo e(request('q')); ?>" class="form-control ps-5"
                           placeholder="Cari judul, kode arsip, atau lokasi..." data-live-search autocomplete="off">
                    <span class="search-spinner d-none" data-search-spinner></span>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Kategori</label>
                    <select name="kategori_id" class="form-select" data-auto-submit>
                        <option value="">Semua kategori</option>
                        <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id); ?>" <?php if(request('kategori_id') == $k->id): echo 'selected'; endif; ?>><?php echo e($k->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Kondisi</label>
                    <select name="kondisi" class="form-select" data-auto-submit>
                        <option value="">Semua kondisi</option>
                        <?php $__currentLoopData = $kondisiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php if(request('kondisi') === $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="form-label small fw-semibold">Urutkan</label>
                    <select name="urut" class="form-select" data-auto-submit>
                        <option value="">Terbaru ditambahkan</option>
                        <option value="judul" <?php if(request('urut') === 'judul'): echo 'selected'; endif; ?>>Judul</option>
                        <option value="tahun" <?php if(request('urut') === 'tahun'): echo 'selected'; endif; ?>>Tahun rekaman</option>
                        <option value="kondisi" <?php if(request('urut') === 'kondisi'): echo 'selected'; endif; ?>>Kondisi</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2 d-flex gap-2">
                    <a href="<?php echo e(route('pita.index')); ?>" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label small fw-semibold d-block mb-2"><i class="bi bi-exclamation-triangle text-amber"></i> Filter kerusakan <span class="text-muted">(pilih lebih dari satu)</span></label>
                <div class="d-flex flex-wrap gap-2">
                    <?php $__currentLoopData = $kerusakanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3e43da63772e725970863e9067088b49 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e43da63772e725970863e9067088b49 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chip','data' => ['name' => 'kerusakan[]','value' => $kr->id,'label' => $kr->nama,'checked' => in_array($kr->id, (array) request('kerusakan', [])),'dataAutoSubmit' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'kerusakan[]','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kr->id),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kr->nama),'checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(in_array($kr->id, (array) request('kerusakan', []))),'data-auto-submit' => true]); ?>
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

<div id="pita-results">
    <?php echo $__env->make('pita.partials.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/pita/index.blade.php ENDPATH**/ ?>