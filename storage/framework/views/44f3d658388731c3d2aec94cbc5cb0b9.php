<?php $__env->startSection('title', 'Detail Peserta'); ?>
<?php $__env->startSection('peserta-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="row">
        <!-- Main Information Card -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i> Informasi Peserta
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Nama Lengkap -->
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Nama Lengkap</label>
                                <div class="info-value"><?php echo e($participant->nama); ?></div>
                            </div>
                        </div>

                        <!-- NIK & NISN/NIM -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">NIK</label>
                                <div class="info-value"><?php echo e($participant->nik); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">NISN / NIM</label>
                                <div class="info-value"><?php echo e($participant->nisnim); ?></div>
                            </div>
                        </div>

                        <!-- Jenis Kelamin & Jurusan -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Jenis Kelamin</label>
                                <div class="info-value">
                                    <?php if($participant->jenis_kelamin === 'L'): ?>
                                        <p>Laki-laki</p>
                                    <?php elseif($participant->jenis_kelamin === 'P'): ?>
                                        <p>Perempuan</p>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Jurusan</label>
                                <div class="info-value"><?php echo e($participant->jurusan); ?></div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Kontak</label>
                                <div class="info-value">
                                    <?php echo e($participant->kontak_peserta ?? '-'); ?>

                                </div>
                            </div>
                        </div>

                        <!-- Tahun Aktif -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Tahun Aktif</label>
                                <div class="info-value">
                                    <?php echo e($participant->tahun_aktif ?? '-'); ?>

                                </div>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Keterangan</label>
                                <div class="info-value">
                                    <?php if($participant->keterangan): ?>
                                        <div class="bg-light p-3 rounded">
                                            <?php echo e($participant->keterangan); ?>

                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada keterangan</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="<?php echo e(route('admin.peserta.edit', $participant->id)); ?>" class="btn btn-primary me-2">Edit</a>
                        <a href="<?php echo e(route('admin.peserta.index')); ?>" class="btn btn-secondary">Kembali</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Minimal CSS -->
<style>
.info-item { margin-bottom: 0.75rem; }
.info-label { font-size: 0.9rem; font-weight: 600; color: #6c757d; margin-bottom: 0.25rem; display: block; }
.info-value { font-size: 1rem; color: #343a40; min-height: 1.2rem; }
.card { border-radius: 0.5rem; }
.card-header { border-bottom: none; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/peserta/detail.blade.php ENDPATH**/ ?>