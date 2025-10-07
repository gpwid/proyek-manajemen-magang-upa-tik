
<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Profil Akun</h1>

        <?php if(!$user->participant): ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Perhatian!</strong> Anda harus melengkapi data diri di bawah ini untuk dapat menggunakan fitur lain.
            </div>
        <?php endif; ?>

        <?php if(session('status') === 'profile-updated'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fa-solid fa-user me-2"></i> Detail Akun
                </h5>
            </div>
            <div class="card-body">
                
                <form method="post" action="<?php echo e(route('pemagang.profile.update')); ?>" class="mt-6 space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('patch'); ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="<?php echo e(old('name', $user->name)); ?>" required autofocus>
                        <?php if($errors->get('name')): ?>
                            <div class="text-danger mt-2"><?php echo e($errors->first('name')); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control"
                            value="<?php echo e(old('email', $user->email)); ?>" required>
                        <?php if($errors->get('email')): ?>
                            <div class="text-danger mt-2"><?php echo e($errors->first('email')); ?></div>
                        <?php endif; ?>
                    </div>

                    
                    <h6 class="font-weight-bold mt-4">Data Diri Peserta</h6>
                    <hr class="mt-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nik"
                                name="nik" value="<?php echo e(old('nik', $user->participant->nik ?? '')); ?>" required>
                            <?php $__errorArgs = ['nik'];
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
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="" disabled>Pilih...</option>
                                <option value="L" <?php if(old('jenis_kelamin', $user->participant->jenis_kelamin ?? '') == 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
                                <option value="P" <?php if(old('jenis_kelamin', $user->participant->jenis_kelamin ?? '') == 'P'): echo 'selected'; endif; ?>>Perempuan</option>
                            </select>
                            <?php $__errorArgs = ['jenis_kelamin'];
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jurusan" class="form-label">Jurusan/Program Studi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="jurusan"
                                name="jurusan" value="<?php echo e(old('jurusan', $user->participant->jurusan ?? '')); ?>" required>
                            <?php $__errorArgs = ['jurusan'];
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
                        <div class="col-md-6 mb-3">
                            <label for="kontak_peserta" class="form-label">Nomor Telepon/WA <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['kontak_peserta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="kontak_peserta" name="kontak_peserta"
                                value="<?php echo e(old('kontak_peserta', $user->participant->kontak_peserta ?? '')); ?>" required>
                            <?php $__errorArgs = ['kontak_peserta'];
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun_aktif" class="form-label">Tahun Masuk/Angkatan <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['tahun_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="tahun_aktif" name="tahun_aktif"
                                value="<?php echo e(old('tahun_aktif', $user->participant->tahun_aktif ?? '')); ?>" required>
                            <?php $__errorArgs = ['tahun_aktif'];
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
                        <div class="col-md-6 mb-3">
                            <label for="alamat_asal" class="form-label">Alamat Asal</label>
                            <input type="text" class="form-control" id="alamat_asal" name="alamat_asal"
                                value="<?php echo e(old('alamat_asal', $user->participant->alamat_asal ?? '')); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                value="<?php echo e(old('nama_wali', $user->participant->nama_wali ?? '')); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kontak_wali" class="form-label">Kontak Wali</label>
                            <input type="text" class="form-control" id="kontak_wali" name="kontak_wali"
                                value="<?php echo e(old('kontak_wali', $user->participant->kontak_wali ?? '')); ?>">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>

                        <?php if(session('status') === 'profile-updated'): ?>
                            <p class="text-success">Tersimpan.</p>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fa-solid fa-key me-2"></i> Ubah Password
                </h5>
            </div>
            <div class="card-body">
                
                <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pemagang.layoutspemagang.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pemagang/profile/edit.blade.php ENDPATH**/ ?>