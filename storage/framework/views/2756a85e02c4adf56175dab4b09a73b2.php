<div class="card glass-card">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center px-4 pt-3">
            <span class="small text-muted"><span data-total><?php echo e($pitaList->total()); ?></span> pita ditemukan</span>
        </div>
        <div class="table-responsive p-3 pt-2">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode Arsip</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>Kerusakan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pitaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="row-enter">
                        <td><code class="code-chip"><?php echo e($pita->kode_arsip); ?></code></td>
                        <td>
                            <a href="<?php echo e(route('pita.show', $pita)); ?>" class="fw-semibold text-decoration-none title-link"><?php echo e($pita->judul); ?></a>
                            <div class="small text-muted"><i class="bi bi-geo-alt"></i> <?php echo e($pita->lokasi_simpan ?? '—'); ?></div>
                        </td>
                        <td><span class="badge badge-soft badge-amber"><?php echo e($pita->kategori->nama); ?></span></td>
                        <td><?php echo e($pita->tahun_rekaman ?? '—'); ?></td>
                        <td><?php if (isset($component)) { $__componentOriginald8e7ea6db34300b70b2c121571e88e40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8e7ea6db34300b70b2c121571e88e40 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kondisi-badge','data' => ['kondisi' => $pita->kondisi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kondisi-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kondisi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pita->kondisi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8e7ea6db34300b70b2c121571e88e40)): ?>
<?php $attributes = $__attributesOriginald8e7ea6db34300b70b2c121571e88e40; ?>
<?php unset($__attributesOriginald8e7ea6db34300b70b2c121571e88e40); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8e7ea6db34300b70b2c121571e88e40)): ?>
<?php $component = $__componentOriginald8e7ea6db34300b70b2c121571e88e40; ?>
<?php unset($__componentOriginald8e7ea6db34300b70b2c121571e88e40); ?>
<?php endif; ?></td>
                        <td>
                            <?php $__empty_2 = true; $__currentLoopData = $pita->kerusakan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                <span class="mini-tag"><?php echo e($kr->nama); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                <span class="text-muted small">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="<?php echo e(route('pita.show', $pita)); ?>" class="btn btn-sm btn-icon" title="Lihat"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo e(route('pita.edit', $pita)); ?>" class="btn btn-sm btn-icon" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <?php if (isset($component)) { $__componentOriginal838d685df97fa06f0dd63cf6cba769a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal838d685df97fa06f0dd63cf6cba769a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-form','data' => ['action' => route('pita.destroy', $pita),'message' => 'Hapus pita '.$pita->judul.'?','label' => '','small' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('delete-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('pita.destroy', $pita)),'message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Hapus pita '.$pita->judul.'?'),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'small' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['message' => 'Tidak ada pita yang cocok dengan filter.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => 'Tidak ada pita yang cocok dengan filter.']); ?>
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
        <div class="px-4 pb-3"><?php echo e($pitaList->links()); ?></div>
    </div>
</div>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/pita/partials/table.blade.php ENDPATH**/ ?>