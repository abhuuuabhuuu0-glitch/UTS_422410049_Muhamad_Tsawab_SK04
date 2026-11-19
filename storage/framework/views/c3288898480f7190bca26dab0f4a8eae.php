<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'subtitle' => null, 'icon' => 'bi-collection']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title', 'subtitle' => null, 'icon' => 'bi-collection']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="page-icon"><i class="bi <?php echo e($icon); ?>"></i></span>
        <div>
            <h1 class="h3 fw-bold mb-0"><?php echo e($title); ?></h1>
            <?php if($subtitle): ?><p class="text-muted mb-0"><?php echo e($subtitle); ?></p><?php endif; ?>
        </div>
    </div>
    <div class="d-flex gap-2"><?php echo e($slot); ?></div>
</div>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/page-header.blade.php ENDPATH**/ ?>