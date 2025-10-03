<?php $__env->startSection('permohonan-active', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800">Detail Permohonan</h1>
            <div class="mt-4 text-end">
                <a href="<?php echo e(route('admin.permohonan.edit', $permohonan->id)); ?>" class="btn btn-primary me-2"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="btn btn-secondary">Kembali</a>
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
            <!-- Main Information Card -->
            <div class="col-md-12">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fa-solid fa-file-contract me-2"></i> Informasi Permohonan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Nama Lengkap -->
                            <div class="col-12">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Asal Instansi Surat</label>
                                    <div class="info-value" style="font-weight: 700"><?php echo e($permohonan->instansi); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Jenis Magang</label>
                                    <div class="info-value" style="font-weight: 700"><?php echo e($permohonan->jenis_magang); ?></div>
                                </div>
                            </div>

                            <!-- NIK & NISN/NIM -->
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Surat dibuat</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->tgl_surat->format('d-m-Y')); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Surat Masuk</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->tgl_suratmasuk->format('d-m-Y')); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Status</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php if($permohonan->status === 'Aktif'): ?>
                                            <span class='badge bg-success'><?php echo e($permohonan->status); ?></span>
                                        <?php elseif($permohonan->status === 'Proses'): ?>
                                            <span class='badge bg-warning text-dark'><?php echo e($permohonan->status); ?></span>
                                        <?php elseif($permohonan->status === 'Selesai'): ?>
                                            <span class='badge bg-primary'><?php echo e($permohonan->status); ?></span>
                                        <?php elseif($permohonan->status === 'Ditolak'): ?>
                                            <span class='badge bg-danger'><?php echo e($permohonan->status); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Mulai Magang</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->tgl_mulai->format('d-m-Y')); ?></div>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Selesai Magang</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->tgl_selesai->format('d-m-Y')); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Pembimbing dari Instansi</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->pembimbing_sekolah); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Kontak Pembimbing</label>
                                    <div class="info-value" style="font-weight: 700">
                                        <?php echo e($permohonan->kontak_pembimbing); ?>

                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="col-12 d-flex bg-primary rounded-top justify-content-between">
                                    <div class="align-self-center">
                                        <label class="mt-2 text-white text-lg">File PDF Permohonan</label>
                                    </div>
                                    <div>
                                        <a download class="btn btn-success me-2 my-2"
                                            href="<?php echo e(Storage::url($permohonan->file_permohonan)); ?>"><i
                                                class="fa-solid fa-file-arrow-down"></i> Unduh file</a>
                                    </div>
                                </div>

                                <div class="col-12 ratio ratio-16x9">
                                    <iframe src="/storage/<?php echo e($permohonan->file_permohonan); ?>" title="PDF Reader"
                                        style="border:0"></iframe>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek-manajemen-magang-upa-tik\resources\views/admin/permohonan/show.blade.php ENDPATH**/ ?>