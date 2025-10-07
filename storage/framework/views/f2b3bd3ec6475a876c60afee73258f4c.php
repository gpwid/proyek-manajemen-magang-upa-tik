<?php $__env->startSection('title', 'Status Absensi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow-sm text-center">
                    <div class="card-body p-5">
                        <?php if(isset($isError) && $isError): ?>
                            <i class="fa fa-times-circle fa-4x text-danger mb-3"></i>
                            <h3 class="text-danger">Gagal!</h3>
                        <?php else: ?>
                            <i class="fa fa-check-circle fa-4x text-success mb-3"></i>
                            <h3>Berhasil!</h3>
                        <?php endif; ?>
                        <p class="lead"><?php echo e($message); ?></p>
                        <a href="<?php echo e(route('pemagang.dashboard.index')); ?>" class="btn btn-primary mt-3">Kembali ke
                            Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pemagang.layoutspemagang.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pemagang/attendance/result.blade.php ENDPATH**/ ?>