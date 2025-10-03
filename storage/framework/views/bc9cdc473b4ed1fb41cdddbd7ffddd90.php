<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Register'); ?>

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="user" method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="name" name="name"
                value="<?php echo e(old('name')); ?>" required autofocus placeholder="Nama Lengkap">
        </div>

        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="nomor_unik" name="nomor_unik"
                value="<?php echo e(old('nomor_unik')); ?>" required autofocus placeholder="NISN/NIM">
        </div>

        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email"
                value="<?php echo e(old('email')); ?>" placeholder="Alamat Email (opsional)">
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="password" name="password" required
                    placeholder="Password">
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="password_confirmation"
                    name="password_confirmation" required placeholder="Ulangi Password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-user btn-block">
            Register Akun
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="<?php echo e(route('login')); ?>">Sudah punya akun? Login!</a>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/auth/register.blade.php ENDPATH**/ ?>