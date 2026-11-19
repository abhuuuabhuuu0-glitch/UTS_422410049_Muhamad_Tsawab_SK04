<div class="card glass-card">
    <div class="card-body p-0">
        <div class="px-4 pt-3 small text-muted"><span data-total><?php echo e($restorasiList->total()); ?></span> proyek ditemukan</div>
        <div class="table-responsive p-3 pt-2">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>Pita</th><th>Teknisi</th><th>Periode</th><th>Tahap</th><th>Biaya</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $restorasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="row-enter">
                        <td>
                            <a href="<?php echo e(route('restorasi.show', $r)); ?>" class="fw-semibold text-decoration-none title-link"><?php echo e($r->pita->judul); ?></a>
                            <div><code class="code-chip"><?php echo e($r->pita->kode_arsip); ?></code></div>
                        </td>
                        <td><?php echo e($r->teknisi->nama ?? '—'); ?></td>
                        <td class="small">
                            <?php echo e($r->tanggal_mulai->format('d M Y')); ?>

                            <?php if($r->tanggal_selesai): ?><br><span class="text-muted">s/d <?php echo e($r->tanggal_selesai->format('d M Y')); ?></span><?php endif; ?>
                        </td>
                        <td><span class="badge badge-soft badge-primary"><?php echo e($r->detail_count); ?> tahap</span></td>
                        <td class="fw-semibold">Rp <?php echo e(number_format($r->biaya, 0, ',', '.')); ?></td>
                        <td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $r->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($r->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td>
                        <td class="text-end text-nowrap">
                            <a href="<?php echo e(route('restorasi.show', $r)); ?>" class="btn btn-sm btn-icon" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo e(route('restorasi.edit', $r)); ?>" class="btn btn-sm btn-icon" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <?php if (isset($component)) { $__componentOriginal838d685df97fa06f0dd63cf6cba769a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal838d685df97fa06f0dd63cf6cba769a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-form','data' => ['action' => route('restorasi.destroy', $r),'message' => 'Hapus proyek restorasi ini beserta seluruh tahapannya?','label' => '','small' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('delete-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('restorasi.destroy', $r)),'message' => 'Hapus proyek restorasi ini beserta seluruh tahapannya?','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'small' => true]); ?>
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
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['message' => 'Tidak ada proyek yang cocok dengan filter.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => 'Tidak ada proyek yang cocok dengan filter.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-4 pb-3"><?php echo e($restorasiList->links()); ?></div>
    </div>
</div>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/restorasi/partials/table.blade.php ENDPATH**/ ?>