<div class="card glass-card">
    <div class="card-body p-4">
        <div class="mb-3">
            <label class="form-label fw-semibold" for="nama">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $kategori->nama)); ?>"
                   class="form-control form-control-lg <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="100" required>
            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold" for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="500"
                      class="form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('deskripsi', $kategori->deskripsi)); ?></textarea>
            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-amber px-4"><i class="bi bi-save"></i> Simpan</button>
            <a href="<?php echo e(route('kategori.index')); ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
    </div>
</div>
<?php /**PATH C:\sk04-restorasi-pita-analog\resources\views/kategori/_form.blade.php ENDPATH**/ ?>