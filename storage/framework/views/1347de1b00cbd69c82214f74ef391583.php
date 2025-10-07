<?php $__env->startSection('internship-active', 'active'); ?>
<?php $__env->startSection('title', 'Detail Data Magang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800">Detail Data Magang</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.internship.edit', $internship->id)); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <a href="<?php echo e(route('admin.internship.index')); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fa-solid fa-file-contract me-2"></i> Informasi Magang
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">

                            <div class="col-12">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Asal Pemagang</label>
                                    <div class="info-value fw-bold">
                                        <?php echo e($internship->permohonan?->institute?->nama_instansi ?? '-'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Jenis Magang</label>
                                    <div class="info-value fw-bold">
                                        <?php echo e($internship->permohonan?->jenis_magang ?? '-'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Mulai</label>
                                    <div class="info-value fw-bold">
                                        <?php echo e($internship->permohonan?->tgl_mulai?->format('d-m-Y') ?? '-'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Selesai</label>
                                    <div class="info-value fw-bold">
                                        <?php echo e($internship->permohonan?->tgl_selesai?->format('d-m-Y') ?? '-'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Status</label>
                                    <div class="info-value fw-bold">
                                        <?php if($internship->status_magang === 'Aktif'): ?>
                                            <span class="badge bg-success"><?php echo e($internship->status_magang); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo e($internship->status_magang); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Pembimbing</label>
                                    <div class="info-value fw-bold">
                                        <?php echo e($internship->supervisor?->nama ?? '-'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Nama-nama Pemagang</label>
                                    <div class="info-value fw-bold">
                                        <?php if($internship->participants->isEmpty()): ?>
                                            <span class="text-muted">Belum ada peserta.</span>
                                        <?php else: ?>
                                            <ul class="mb-0">
                                                <?php $__currentLoopData = $internship->participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($i + 1); ?>. <?php echo e($pm->nama); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /row -->
                    </div> <!-- /card-body -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/internship/detail.blade.php ENDPATH**/ ?>