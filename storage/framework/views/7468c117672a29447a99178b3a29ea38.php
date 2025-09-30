<?php $__env->startSection('title', 'Tambah Permohonan Baru'); ?>
<?php $__env->startSection('permohonan-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        
        <style>
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
            }
        </style>

        
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Permohonan</h1>
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
                <form action="<?php echo e(route('admin.permohonan.store')); ?>" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Info Surat</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_surat" value="<?php echo e(old('tgl_surat')); ?>"
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
                                <input type="text" name="no_surat" value="<?php echo e(old('no_surat')); ?>"
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
                                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($x->id); ?>"
                                            <?php echo e(old('id_institute') == $x->id ? 'selected' : ''); ?>>
                                            <?php echo e($x->nama_instansi); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="">Tidak Ada Instansi</option>
                                    <?php endif; ?>
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
                                            <?php if(old('jenis_magang') == '<?php echo e($jm); ?>'): ?> selected <?php endif; ?>><?php echo e($jm); ?>

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
                                <input type="date" name="tgl_mulai" value="<?php echo e(old('tgl_mulai')); ?>"
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
                                <input type="date" name="tgl_selesai" value="<?php echo e(old('tgl_selesai')); ?>"
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
                                <input type="text" name="pembimbing_sekolah" value="<?php echo e(old('pembimbing_sekolah')); ?>"
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
                                <input type="text" name="kontak_pembimbing" value="<?php echo e(old('kontak_pembimbing')); ?>"
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
                            <h6 class="fw-bold mb-0">Catatan</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <input type="text" name="catatan" value="<?php echo e(old('catatan')); ?>"
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

                    
                    <div class="mb-2">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Berkas</h6>
                            <span class="ms-2 text-muted small">Wajib unggah file permohonan (PDF)</span>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            <div class="col-md-6">
                                <label class="form-label">File Permohonan <span class="text-danger">*</span></label>
                                <input type="file" name="file_permohonan"
                                    class="form-control <?php $__errorArgs = ['file_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
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
                                <div class="form-text">Format disarankan: PDF. Maks 5 MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">File Surat Balasan</label>
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
                                <div class="form-text">Opsional (jika sudah ada).</div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <a class="btn btn-secondary" href="<?php echo e(route('admin.permohonan.index')); ?>">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-user-plus"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/permohonan/tambah.blade.php ENDPATH**/ ?>