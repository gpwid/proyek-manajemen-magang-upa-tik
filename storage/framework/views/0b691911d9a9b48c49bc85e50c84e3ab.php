<?php $__env->startSection('title', 'Edit Permohonan'); ?>
<?php $__env->startSection('permohonan-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        
        <style>
            /* garis pemisah di kolom kanan bila layout 2 kolom (>= md) */
            .row-split>.col-md-6+.col-md-6 {
                border-left: 1px solid var(--bs-border-color, #dee2e6);
            }

            .row-split>.col-md-6 {
                padding-top: .25rem;
                padding-bottom: .25rem;
            }

            @media (min-width: 768px) {
                .row-split>.col-md-6:first-child {
                    padding-right: 1rem;
                }

                .row-split>.col-md-6:last-child {
                    padding-left: 1rem;
                }
            }

            @media (max-width: 767.98px) {
                .row-split>.col-md-6+.col-md-6 {
                    border-left: 0;
                }

                /* hide di mobile */
            }
        </style>

        
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800 mb-0">Edit Permohonan</h1>
            
        </div>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger border-0 shadow-sm">
                <div class="fw-semibold mb-2">Periksa kembali input berikut:</div>
                <ul class="mb-0 ps-3">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="card shadow-sm">
            <div class="card-body">
                
                <form action="<?php echo e(route('admin.permohonan.update', $application->id)); ?>" method="POST"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Info Surat</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_surat"
                                    value="<?php echo e(old('tgl_surat', optional($application->tgl_surat)->format('Y-m-d'))); ?>"
                                    class="form-control <?php $__errorArgs = ['tgl_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['tgl_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">No. Surat <span class="text-danger">*</span></label>
                                <input type="text" name="no_surat"
                                    value="<?php echo e(old('no_surat', $application->no_surat ?? '')); ?>"
                                    class="form-control <?php $__errorArgs = ['no_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="100" required>
                                <?php $__errorArgs = ['no_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Instansi</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">Instansi <span class="text-danger">*</span></label>
                                <select name="id_institute" class="form-select <?php $__errorArgs = ['id_institute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                    <option value="">-- Pilih Instansi --</option>
                                    <?php $__currentLoopData = $searchinstitutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($x->id); ?>"
                                            <?php echo e(old('id_institute', $application->id_institute) == $x->id ? 'selected' : ''); ?>>
                                            <?php echo e($x->nama_instansi); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['id_institute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">Jenis Magang <span class="text-danger">*</span></label>
                                <select name="jenis_magang" class="form-select <?php $__errorArgs = ['jenis_magang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                    <?php $__currentLoopData = ['Mandiri', 'MBKM', 'Sekolah']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($jm); ?>"
                                            <?php echo e(old('jenis_magang', $application->jenis_magang) == $jm ? 'selected' : ''); ?>>
                                            <?php echo e($jm); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['jenis_magang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Periode Magang</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai"
                                    value="<?php echo e(old('tgl_mulai', optional($application->tgl_mulai)->format('Y-m-d'))); ?>"
                                    class="form-control <?php $__errorArgs = ['tgl_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['tgl_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai"
                                    value="<?php echo e(old('tgl_selesai', optional($application->tgl_selesai)->format('Y-m-d'))); ?>"
                                    class="form-control <?php $__errorArgs = ['tgl_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['tgl_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Pembimbing</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">Pembimbing Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="pembimbing_sekolah"
                                    value="<?php echo e(old('pembimbing_sekolah', $application->pembimbing_sekolah)); ?>"
                                    class="form-control <?php $__errorArgs = ['pembimbing_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="100"
                                    required>
                                <?php $__errorArgs = ['pembimbing_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">Kontak Pembimbing <span class="text-danger">*</span></label>
                                <input type="text" name="kontak_pembimbing"
                                    value="<?php echo e(old('kontak_pembimbing', $application->kontak_pembimbing)); ?>"
                                    class="form-control <?php $__errorArgs = ['kontak_pembimbing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="20"
                                    placeholder="08xxxxxxxxxx" required>
                                <?php $__errorArgs = ['kontak_pembimbing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Status & Catatan</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <?php $__currentLoopData = ['Proses', 'Aktif', 'Selesai', 'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($st); ?>"
                                            <?php echo e(old('status', $application->status) == $st ? 'selected' : ''); ?>>
                                            <?php echo e($st); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">Catatan</label>
                                <input type="text" name="catatan" value="<?php echo e(old('catatan', $application->catatan)); ?>"
                                    class="form-control <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="255"
                                    placeholder="Opsional">
                                <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Berkas</h6>
                            <span class="ms-2 text-muted small">Unggah ulang hanya bila ingin mengganti</span>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            
                            <div class="col-md-6">
                                <label class="form-label">File Permohonan</label>
                                <?php if($application->file_permohonan): ?>
                                    <div class="mb-2">
                                        <a target="_blank" class="link-primary"
                                            href="<?php echo e(Storage::url($application->file_permohonan)); ?>">
                                            Lihat file saat ini
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="file_permohonan"
                                    class="form-control <?php $__errorArgs = ['file_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <?php $__errorArgs = ['file_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="form-text">Format: PDF. Maks 5 MB.</div>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label">File Surat Balasan</label>
                                <?php if($application->file_suratbalasan): ?>
                                    <div class="mb-2">
                                        <a target="_blank" class="link-primary"
                                            href="<?php echo e(Storage::url($application->file_suratbalasan)); ?>">
                                            Lihat file saat ini
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="file_suratbalasan"
                                    class="form-control <?php $__errorArgs = ['file_suratbalasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <?php $__errorArgs = ['file_suratbalasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <a class="btn btn-secondary" href="<?php echo e(route('admin.permohonan.index')); ?>">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/permohonan/edit.blade.php ENDPATH**/ ?>