
<section>
    <form method="post" action="<?php echo e(route('password.update')); ?>" class="mt-3">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                autocomplete="current-password" required>
            <?php if($errors->updatePassword->get('current_password')): ?>
                <div class="text-danger mt-2"><?php echo e($errors->updatePassword->first('current_password')); ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control"
                autocomplete="new-password" required>
            <?php if($errors->updatePassword->get('password')): ?>
                <div class="text-danger mt-2"><?php echo e($errors->updatePassword->first('password')); ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control" autocomplete="new-password" required>
            <?php if($errors->updatePassword->get('password_confirmation')): ?>
                <div class="text-danger mt-2"><?php echo e($errors->updatePassword->first('password_confirmation')); ?></div>
            <?php endif; ?>
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?php if(session('status') === 'password-updated'): ?>
                <p class="text-success mb-0">Password berhasil diubah.</p>
            <?php endif; ?>
        </div>
    </form>
</section>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>