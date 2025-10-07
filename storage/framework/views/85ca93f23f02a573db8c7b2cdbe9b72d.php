<?php $__env->startSection('internship-active', 'active'); ?>
<?php $__env->startSection('title', 'Edit Data Magang'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Form Edit Data Magang</h1>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow col-12 p-4">
            <form action="<?php echo e(route('admin.internship.update', $internship->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label class="form-label">Permohonan <span class="text-danger">*</span></label>
                    <select name="id_permohonan" class="form-control select2 <?php $__errorArgs = ['id_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">-- Pilih Permohonan --</option>
                        <?php $__currentLoopData = $permohonan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pm->id); ?>"
                                <?php echo e(old('id_permohonan', $internship->id_permohonan) == $pm->id ? 'selected' : ''); ?>>
                                <?php echo e($pm->no_surat); ?> - <?php echo e($pm->institute->nama_instansi ?? 'Nama Instansi Tidak Ditemukan'); ?>

                                (<?php echo e($pm->tgl_surat->format('d-m-Y')); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['id_permohonan'];
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

                
                <div class="mb-3">
                    <label class="form-label">Pembimbing <span class="text-danger">*</span></label>
                    <select name="id_pembimbing" class="form-control select2 <?php $__errorArgs = ['id_pembimbing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">-- Pilih Pembimbing --</option>
                        <?php $__currentLoopData = $supervisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sup->id); ?>"
                                <?php echo e(old('id_pembimbing', $internship->id_pembimbing) == $sup->id ? 'selected' : ''); ?>>
                                <?php echo e($sup->nama); ?> (<?php echo e($sup->nip); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['id_pembimbing'];
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

                
                <div class="mb-3">
                    <label class="form-label">Peserta <span class="text-danger">*</span></label>

                    <?php
                        $selectedParticipants = old('id_peserta', $internship->participants->pluck('id')->all());
                    ?>

                    <select name="id_peserta[]" class="form-control select2 <?php $__errorArgs = ['id_peserta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        multiple required>
                        <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peserta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($peserta->id); ?>"
                                <?php echo e(in_array($peserta->id, $selectedParticipants) ? 'selected' : ''); ?>>
                                <?php echo e($peserta->nama); ?> (<?php echo e($peserta->nik); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['id_peserta'];
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

                
                <div class="mb-3">
                    <label class="form-label">Status Magang <span class="text-danger">*</span></label>
                    <select name="status_magang" class="form-control <?php $__errorArgs = ['status_magang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif"
                            <?php echo e(old('status_magang', $internship->status_magang) == 'Aktif' ? 'selected' : ''); ?>>Aktif
                        </option>
                        <option value="Nonaktif"
                            <?php echo e(old('status_magang', $internship->status_magang) == 'Nonaktif' ? 'selected' : ''); ?>>Nonaktif
                        </option>
                        <option value="Tidak Selesai"
                            <?php echo e(old('status_magang', $internship->status_magang) == 'Tidak Selesai' ? 'selected' : ''); ?>>
                            Tidak Selesai
                        </option>
                    </select>
                    <?php $__errorArgs = ['status_magang'];
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

                <div class="d-flex justify-content-end">
                    <a class="btn btn-secondary mr-2" href="<?php echo e(route('admin.internship.index')); ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    /* ====== Modernize Select2 (single select) ====== */
    .select2-container .select2-selection--single {
        height: 44px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        /* abu-abu lembut */
        display: flex !important;
        align-items: center !important;
        padding: 0 .75rem !important;
        position: relative !important;
        /* untuk posisikan clear btn */
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
    }

    .select2-container--bootstrap4 .select2-selection--single,
    .select2-container--bootstrap-5 .select2-selection--single {
        padding-right: 2.25rem !important;
        /* ruang untuk ikon panah/clear */
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 1.4 !important;
        padding-left: 0 !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: .75rem !important;
    }

    .select2-container .select2-selection--single .select2-selection__clear {
        position: absolute !important;
        right: 2rem !important;
        /* di kiri panah */
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin: 0 !important;
        font-size: 18px !important;
        color: #9ca3af !important;
    }

    .select2-container .select2-selection--single .select2-selection__clear:hover {
        color: #111827 !important;
    }

    /* Fokus: warna & ring halus */
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--bootstrap4.select2-container--focus .select2-selection--single,
    .select2-container--bootstrap-5.select2-container--focus .select2-selection--single {
        border-color: #c7d2fe !important;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
        /* indigo ring */
    }

    /* Dropdown: lebih lega & modern */
    .select2-results__option {
        padding: .55rem .75rem !important;
        border-radius: .5rem !important;
        margin: 2px !important;
    }

    .select2-results__option--highlighted {
        background: #eef2ff !important;
        color: #1f2937 !important;
    }

    /* Placeholder agar abu-abu muda */
    .select2-container .select2-selection__placeholder {
        color: #9ca3af !important;
    }

    /* ---- Select2 clear (single select) jadi merah ---- */
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear,
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__clear {
        color: #dc3545 !important;
        /* Bootstrap danger */
        opacity: 1 !important;
        cursor: pointer;
        font-weight: 700;
        /* (opsional) bikin area klik sedikit lebih besar & bundar */
        padding: 2px 6px;
        border-radius: 9999px;
    }

    /* Hover state: lebih tegas */
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear:hover,
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__clear:hover {
        color: #b02a37 !important;
        /* darker danger */
        background: rgba(220, 53, 69, .08);
    }
</style>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Pilih --',
                allowClear: true,
                language: {
                    inputTooShort: () => 'Ketik untuk mencari…',
                    noResults: () => 'Tidak ada data'
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/internship/edit.blade.php ENDPATH**/ ?>