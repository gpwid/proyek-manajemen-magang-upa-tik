<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('dashboard-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo e($greeting); ?>, <?php echo e($user->name); ?>! 👋</h1>
        </div>

        <?php if($activeInternship): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Magang Aktif</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-building mr-1"></i> Instansi</strong>
                            <p class="text-muted"><?php echo e($activeInternship->permohonan->institute->nama_instansi ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-user-tie mr-1"></i> Pembimbing Lapangan</strong>
                            <p class="text-muted"><?php echo e($activeInternship->supervisor->nama ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Mulai</strong>
                            <p class="text-muted">
                                <?php echo e(\Carbon\Carbon::parse($activeInternship->permohonan->tgl_mulai)->translatedFormat('d F Y')); ?>

                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-calendar-check mr-1"></i> Tanggal Selesai</strong>
                            <p class="text-muted">
                                <?php echo e(\Carbon\Carbon::parse($activeInternship->permohonan->tgl_selesai)->translatedFormat('d F Y')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Logbook Telah Diisi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($logbookCount); ?> Hari</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Absensi Hari Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php if($todayAttendance && $todayAttendance->check_in_time): ?>
                                            <span class="text-success">Sudah Check-in</span>
                                            <?php if($todayAttendance->check_out_time): ?>
                                                | <span class="text-primary">Sudah Check-out</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-danger">Belum Absen</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <h4 class="alert-heading">Tidak Ada Sesi Magang Aktif</h4>
                <p>Saat ini Anda tidak terdaftar dalam sesi magang yang sedang berjalan. Silakan hubungi admin jika ini
                    adalah sebuah kesalahan.</p>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pemagang.layoutspemagang.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/pemagang/dashboard/index.blade.php ENDPATH**/ ?>