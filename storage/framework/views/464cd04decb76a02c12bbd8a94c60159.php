<?php $__env->startSection('title', 'Tambah Peserta'); ?>
<?php $__env->startSection('peserta-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <style>
      .row-split > .col-md-6 + .col-md-6 { border-left: 1px solid var(--bs-border-color, #dee2e6); }
      .row-split > .col-md-6 { padding-top: .25rem; padding-bottom: .25rem; }
      @media (min-width: 768px) {
        .row-split > .col-md-6:first-child { padding-right: 1rem; }
        .row-split > .col-md-6:last-child  { padding-left: 1rem; }
      }
      @media (max-width: 767.98px) {
        .row-split > .col-md-6 + .col-md-6 { border-left: 0; }
      }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Tambah Peserta</h1>
    </div>

    <div class="card shadow col-12 p-4">
        
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

        <form action="<?php echo e(route('admin.peserta.store')); ?>" method="POST" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>

            
            <input type="hidden" name="permohonan_id" value="<?php echo e(old('permohonan_id', request('permohonan_id'))); ?>">

            
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Identitas</h6>
                <hr class="mt-2 mb-3">
                <div class="row g-3 row-split">
                    
                    <div class="col-md-6">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="nama"
                            value="<?php echo e(old('nama')); ?>"
                            class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                        <input
                            type="text" 
                            name="nik"
                            value="<?php echo e(old('nik')); ?>"
                            class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan NIK (16 digit)"
                            maxlength="16"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            required
                        >
                        <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Data Akademik</h6>
                <hr class="mt-2 mb-3">
                <div class="row g-3 row-split">
                    
                    <div class="col-md-6">
                        <label class="form-label">NISN/NIM <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="nisnim"
                            value="<?php echo e(old('nisnim')); ?>"
                            class="form-control <?php $__errorArgs = ['nisnim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan NISN/NIM"
                            required
                        >
                        <?php $__errorArgs = ['nisnim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select
                            name="jenis_kelamin"
                            class="form-select <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required
                        >
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="L" <?php echo e(old('jenis_kelamin') === 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                            <option value="P" <?php echo e(old('jenis_kelamin') === 'P' ? 'selected' : ''); ?>>Perempuan</option>
                        </select>
                        <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="row g-3 row-split mt-0">
                    
                    <div class="col-md-6">
                        <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="jurusan"
                            value="<?php echo e(old('jurusan')); ?>"
                            class="form-control <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan jurusan"
                            required
                        >
                        <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Tahun Aktif <span class="text-danger">*</span></label>
                        <input
                            type="text"  
                            name="tahun_aktif"
                            value="<?php echo e(old('tahun_aktif')); ?>"
                            class="form-control <?php $__errorArgs = ['tahun_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Contoh: 2025"
                            maxlength="9"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            required
                        >
                        <?php $__errorArgs = ['tahun_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Kontak</h6>
                <hr class="mt-2 mb-3">
                <div class="row g-3 row-split">
                    
                    <div class="col-md-6">
                        <label class="form-label">Kontak Peserta <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="kontak_peserta"
                            value="<?php echo e(old('kontak_peserta')); ?>"
                            class="form-control <?php $__errorArgs = ['kontak_peserta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Nomor HP/WA (08xxxxxxxxxx)"
                            maxlength="20"
                            required
                        >
                        <?php $__errorArgs = ['kontak_peserta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>

            
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Keterangan</h6>
                <hr class="mt-2 mb-3">
                <input
                    type="text"
                    name="keterangan"
                    value="<?php echo e(old('keterangan')); ?>"
                    class="form-control <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Tambahkan keterangan (opsional)"
                    maxlength="255"
                >
                <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="d-flex justify-content-end gap-2 pt-2">
                <a class="btn btn-secondary"
                   href="<?php echo e(old('permohonan_id', request('permohonan_id')) ? route('admin.permohonan.show', old('permohonan_id', request('permohonan_id'))) : route('admin.peserta.index')); ?>">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/peserta/create.blade.php ENDPATH**/ ?>