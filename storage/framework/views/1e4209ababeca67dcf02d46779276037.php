<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['icon' => 'bi-circle', 'label', 'value', 'tone' => 'amber']));

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

foreach (array_filter((['icon' => 'bi-circle', 'label', 'value', 'tone' => 'amber']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="stat-card tone-<?php echo e($tone); ?> h-100">
    <div class="stat-icon"><i class="bi <?php echo e($icon); ?>"></i></div>
    <div>
        <div class="stat-label"><?php echo e($label); ?></div>
        <div class="stat-value" data-count="<?php echo e($value); ?>"><?php echo e($value); ?></div>
    </div>
</div>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/stat-card.blade.php ENDPATH**/ ?>