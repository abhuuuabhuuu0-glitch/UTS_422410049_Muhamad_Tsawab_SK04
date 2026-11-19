<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

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

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $map = [
        'menunggu' => ['warning', 'bi-hourglass-split'],
        'proses' => ['primary', 'bi-arrow-repeat'],
        'selesai' => ['success', 'bi-check2-circle'],
        'dibatalkan' => ['secondary', 'bi-x-circle'],
    ];
    [$color, $icon] = $map[$status] ?? ['secondary', 'bi-question-circle'];
    $label = \App\Models\Restorasi::STATUS[$status] ?? $status;
?>
<span class="badge rounded-pill badge-soft badge-<?php echo e($color); ?>"><i class="bi <?php echo e($icon); ?> me-1"></i><?php echo e($label); ?></span>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/status-badge.blade.php ENDPATH**/ ?>