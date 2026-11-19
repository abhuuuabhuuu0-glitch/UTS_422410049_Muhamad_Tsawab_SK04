
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name', 'value', 'checked' => false, 'label', 'icon' => null]));

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

foreach (array_filter((['name', 'value', 'checked' => false, 'label', 'icon' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<label class="chip">
    <input type="checkbox" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" <?php if($checked): echo 'checked'; endif; ?> <?php echo e($attributes); ?>>
    <span>
        <?php if($icon): ?><i class="bi <?php echo e($icon); ?> me-1"></i><?php endif; ?><?php echo e($label); ?>

    </span>
</label>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/chip.blade.php ENDPATH**/ ?>