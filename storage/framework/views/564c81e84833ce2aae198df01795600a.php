<?php $__env->startSection('title', 'Detail Permohonan'); ?>
<?php $__env->startSection('permohonan-active', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800">Detail Permohonan</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.permohonan.edit', $application->id)); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="btn btn-secondary">Kembali</a>

                <?php if($application->status === 'Proses'): ?>
                    <form method="POST" action="<?php echo e(route('admin.permohonan.status', $application)); ?>"
                        onsubmit="return confirm('Ubah status menjadi Aktif?');">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="to" value="Aktif">
                        <button class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Set Aktif</button>
                    </form>

                    <form method="POST" action="<?php echo e(route('admin.permohonan.status', $application)); ?>"
                        onsubmit="return confirm('Tolak permohonan ini?');">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="to" value="Ditolak">
                        <button class="btn btn-danger"><i class="fa-solid fa-circle-xmark"></i> Tolak</button>
                    </form>
                <?php endif; ?>

                <?php if($application->status === 'Aktif'): ?>
                    <form method="POST" action="<?php echo e(route('admin.permohonan.status', $application)); ?>"
                        onsubmit="return confirm('Tandai selesai?');">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="to" value="Selesai">
                        <button class="btn btn-primary">Tandai Selesai</button>
                    </form>

                    <form method="POST" action="<?php echo e(route('admin.permohonan.status', $application)); ?>"
                        onsubmit="return confirm('Tolak permohonan ini?');">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="to" value="Ditolak">
                        <button class="btn btn-danger">Tolak</button>
                    </form>
                <?php endif; ?>

                <?php if(in_array($application->status, ['Selesai', 'Ditolak'])): ?>
                    <span class="text-muted">Tidak ada aksi status tersedia.</span>
                <?php endif; ?>
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

        <?php
            // cek keberadaan file di disk 'public'
            $hasPermohonan =
                filled($application->file_permohonan) && Storage::disk('public')->exists($application->file_permohonan);
            $hasSuratBalasan =
                filled($application->file_suratbalasan) &&
                Storage::disk('public')->exists($application->file_suratbalasan);
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fa-solid fa-file-contract me-2"></i> Informasi Permohonan
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        
                        <style>
                            .info-grid {
                                display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 18px 28px
                            }

                            @media (max-width: 992px) {
                                .info-grid {
                                    grid-template-columns: 1fr
                                }
                            }

                            .kv {
                                border: 1px solid #eef0f2;
                                border-radius: 12px;
                                padding: 12px 14px;
                                background: #fff
                            }

                            .kv .label {
                                font-size: .825rem;
                                color: #6c757d;
                                margin: 0
                            }

                            .kv .value {
                                font-weight: 700;
                                margin: 2px 0 0 0
                            }

                            .note-block {
                                grid-column: 1/-1;
                                border: 1px dashed #d9dee3;
                                background: #f8f9fa;
                                border-radius: 12px;
                                padding: 14px
                            }

                            .note-title {
                                font-size: .825rem;
                                color: #6c757d;
                                margin-bottom: 6px
                            }

                            .note-body {
                                white-space: pre-wrap;
                                line-height: 1.55
                            }

                            .note-empty {
                                color: #95a5b0;
                                font-style: italic
                            }

                            .section-head {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                background: #0d6efd;
                                color: #fff;
                                border-radius: 10px 10px 0 0;
                                padding: 10px 14px
                            }

                            .section-body {
                                border: 1px solid #e7ebef;
                                border-top: 0;
                                border-radius: 0 0 10px 10px
                            }
                        </style>

                        <div class="info-grid">

                            <div class="kv">
                                <p class="label">Asal Instansi Surat</p>
                                <p class="value"><?php echo e($application->institute->nama_instansi ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Jenis Magang</p>
                                <p class="value"><?php echo e($application->jenis_magang); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">No. Surat</p>
                                <p class="value"><?php echo e($application->no_surat); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Tanggal Surat Masuk</p>
                                <p class="value"><?php echo e(optional($application->tgl_suratmasuk)->format('d-m-Y') ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Tanggal Surat dibuat</p>
                                <p class="value"><?php echo e(optional($application->tgl_surat)->format('d-m-Y') ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Tanggal Mulai Magang</p>
                                <p class="value"><?php echo e(optional($application->tgl_mulai)->format('d-m-Y') ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Tanggal Selesai Magang</p>
                                <p class="value"><?php echo e(optional($application->tgl_selesai)->format('d-m-Y') ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Status</p>
                                <p class="value">
                                    <?php if($application->status === 'Aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php elseif($application->status === 'Proses'): ?>
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    <?php elseif($application->status === 'Selesai'): ?>
                                        <span class="badge bg-primary">Selesai</span>
                                    <?php elseif($application->status === 'Ditolak'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div class="kv">
                                <p class="label">Pembimbing dari Instansi</p>
                                <p class="value"><?php echo e($application->pembimbing_sekolah ?? '-'); ?></p>
                            </div>

                            <div class="kv">
                                <p class="label">Kontak Pembimbing</p>
                                <p class="value"><?php echo e($application->kontak_pembimbing ?? '-'); ?></p>
                            </div>

                            
                            <div class="note-block">
                                <div class="note-title">Catatan</div>
                                <?php if(filled($application->catatan)): ?>
                                    <div class="note-body"><?php echo e($application->catatan); ?></div>
                                <?php else: ?>
                                    <div class="note-body note-empty">Tidak ada catatan.</div>
                                <?php endif; ?>
                            </div>

                        </div>

                        
                        <div class="mt-4">
                            <div class="section-head">
                                <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i> Peserta pada Surat Permohonan
                                </h5>
                                <span class="badge bg-light text-dark">Total:
                                    <?php echo e($application->participants->count()); ?></span>
                            </div>
                            <div class="section-body p-3">
                                <a href="<?php echo e(route('admin.peserta.create', ['permohonan_id' => $application->id])); ?>"
                                    class="btn btn-sm btn-primary mb-2">
                                    <i class="fa fa-plus"></i> Tambah Peserta
                                </a>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:48px;">No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>NISN/NIM</th>
                                                <th>JK</th>
                                                <th>Jurusan</th>
                                                <th>Kontak</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $application->participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($i + 1); ?></td>
                                                    <td><?php echo e($ps->nama); ?></td>
                                                    <td><?php echo e($ps->nik); ?></td>
                                                    <td><?php echo e($ps->nisnim); ?></td>
                                                    <td><?php echo e($ps->jenis_kelamin); ?></td>
                                                    <td><?php echo e($ps->jurusan); ?></td>
                                                    <td><?php echo e($ps->kontak_peserta); ?></td>
                                                    <td><?php echo e($ps->keterangan ?? '-'); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-4">
                                                        Belum ada peserta untuk permohonan ini.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mt-4">
                            <div class="section-head">
                                <span>File PDF Permohonan</span>
                                <div>
                                    <?php if($hasPermohonan): ?>
                                        <a download class="btn btn-success btn-sm"
                                            href="<?php echo e(Storage::url($application->file_permohonan)); ?>">
                                            <i class="fa-solid fa-file-arrow-down"></i> Unduh
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum diunggah</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="section-body">
                                <div class="ratio ratio-16x9">
                                    <?php if($hasPermohonan): ?>
                                        <iframe src="<?php echo e(Storage::url($application->file_permohonan)); ?>"
                                            title="PDF Permohonan" style="border:0;width:100%;height:70vh"></iframe>
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="height:70vh;">
                                            <div class="text-center text-muted">
                                                <i class="fa-solid fa-file-pdf fa-2x mb-2"></i>
                                                <div>Tidak ada file permohonan untuk ditampilkan.</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mt-4">
                            <div class="section-head">
                                <span>File PDF Surat Balasan</span>
                                <div>
                                    <?php if($hasSuratBalasan): ?>
                                        <a download class="btn btn-success btn-sm"
                                            href="<?php echo e(Storage::url($application->file_suratbalasan)); ?>">
                                            <i class="fa-solid fa-file-arrow-down"></i> Unduh
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum diunggah</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="section-body">
                                <div class="ratio ratio-16x9">
                                    <?php if($hasSuratBalasan): ?>
                                        <iframe src="<?php echo e(Storage::url($application->file_suratbalasan)); ?>"
                                            title="PDF Surat Balasan" style="border:0;width:100%;height:70vh"></iframe>
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="height:70vh;">
                                            <div class="text-center text-muted">
                                                <i class="fa-solid fa-file-pdf fa-2x mb-2"></i>
                                                <div>Tidak ada surat balasan untuk ditampilkan.</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div> 
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/permohonan/show.blade.php ENDPATH**/ ?>