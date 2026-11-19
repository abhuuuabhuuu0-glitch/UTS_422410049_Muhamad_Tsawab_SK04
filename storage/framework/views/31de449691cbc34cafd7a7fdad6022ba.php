<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['kondisi']));

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

foreach (array_filter((['kondisi']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $map = ['baik' => 'success', 'sedang' => 'warning', 'rusak_berat' => 'danger'];
    $label = \App\Models\Pita::KONDISI[$kondisi] ?? $kondisi;
?>
<span class="condition-dot condition-<?php echo e($map[$kondisi] ?? 'secondary'); ?>"></span>
<span class="fw-semibold small"><?php echo e($label); ?></span>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/kondisi-badge.blade.php ENDPATH**/ ?>