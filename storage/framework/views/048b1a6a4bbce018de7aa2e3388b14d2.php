<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>SIMBA - <?php echo $__env->yieldContent('title', 'Login'); ?></title>

    <link href="<?php echo e(asset('asset/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="<?php echo e(asset('asset/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
</head>

<body
    style="background-image: linear-gradient(rgba(78, 115, 223, 0.85), rgba(78, 115, 223, 0.85)), url('<?php echo e('images/bg-unri.jpg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="card shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <?php echo e($slot); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('asset/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/sb-admin-2.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/layouts/guest.blade.php ENDPATH**/ ?>