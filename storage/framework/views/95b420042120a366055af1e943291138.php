<?php $__env->startSection('title', 'Kategori Pita'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Kategori Pita','subtitle' => 'Jenis media analog yang dikelola dalam arsip.','icon' => 'bi-tags']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kategori Pita','subtitle' => 'Jenis media analog yang dikelola dalam arsip.','icon' => 'bi-tags']); ?>
    <a href="<?php echo e(route('kategori.create')); ?>" class="btn btn-amber"><i class="bi bi-plus-lg"></i> Kategori Baru</a>
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

<div class="card glass-card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-center" data-live-form>
            <div class="col-md-6 col-lg-4 search-box">
                <i class="bi bi-search"></i>
                <input type="search" name="q" value="<?php echo e(request('q')); ?>" class="form-control ps-5" placeholder="Cari nama kategori..." data-live-search>
            </div>
        </form>
    </div>
</div>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-xl-4">
            <div class="card glass-card h-100 hover-lift">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="category-badge"><i class="bi bi-disc-fill"></i></span>
                        <span class="badge rounded-pill badge-soft badge-primary"><?php echo e($k->pita_count); ?> pita</span>
                    </div>
                    <h2 class="h5 fw-bold mb-1"><?php echo e($k->nama); ?></h2>
                    <p class="text-muted small flex-grow-1"><?php echo e($k->deskripsi ?: 'Tanpa deskripsi.'); ?></p>
                    <div class="d-flex gap-2 mt-2">
                        <a href="<?php echo e(route('kategori.edit', $k)); ?>" class="btn btn-sm btn-amber-outline"><i class="bi bi-pencil"></i> Ubah</a>
                        <?php if (isset($component)) { $__componentOriginal838d685df97fa06f0dd63cf6cba769a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal838d685df97fa06f0dd63cf6cba769a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-form','data' => ['action' => route('kategori.destroy', $k),'message' => 'Hapus kategori '.$k->nama.'?','small' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('delete-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('kategori.destroy', $k)),'message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Hapus kategori '.$k->nama.'?'),'small' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal838d685df97fa06f0dd63cf6cba769a2)): ?>
<?php $attributes = $__attributesOriginal838d685df97fa06f0dd63cf6cba769a2; ?>
<?php unset($__attributesOriginal838d685df97fa06f0dd63cf6cba769a2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal838d685df97fa06f0dd63cf6cba769a2)): ?>
<?php $component = $__componentOriginal838d685df97fa06f0dd63cf6cba769a2; ?>
<?php unset($__componentOriginal838d685df97fa06f0dd63cf6cba769a2); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12"><div class="card glass-card"><div class="card-body"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['message' => 'Kategori tidak ditemukan.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => 'Kategori tidak ditemukan.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></div></div></div>
    <?php endif; ?>
</div>
<div class="mt-3"><?php echo e($kategori->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/kategori/index.blade.php ENDPATH**/ ?>