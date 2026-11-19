<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['action', 'message' => 'Yakin ingin menghapus data ini?', 'label' => 'Hapus', 'small' => false]));

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

foreach (array_filter((['action', 'message' => 'Yakin ingin menghapus data ini?', 'label' => 'Hapus', 'small' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<form method="POST" action="<?php echo e($action); ?>" class="d-inline" data-confirm="<?php echo e($message); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-<?php echo e($small ? 'sm' : ''); ?> btn-outline-danger">
        <i class="bi bi-trash3"></i> <?php echo e($label); ?>

    </button>
</form>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/components/delete-form.blade.php ENDPATH**/ ?>