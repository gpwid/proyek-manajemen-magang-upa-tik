<?php $__env->startSection('title', 'Isi Logbook Harian'); ?>
<?php $__env->startSection('logbook-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Isi Logbook Harian</h1>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if($todayLogbook): ?>
            <div class="alert alert-success">
                <h4 class="alert-heading"><i class="fa fa-check-circle"></i> Selesai!</h4>
                <p>Anda sudah mengisi logbook untuk hari ini.</p>
                <hr>
                <a href="<?php echo e(route('pemagang.logbook.index')); ?>" class="btn btn-outline-success">Lihat Riwayat Logbook</a>
            </div>
        <?php else: ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Logbook untuk Tanggal
                        <?php echo e(now()->translatedFormat('d F Y')); ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('pemagang.logbook.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="date" value="<?php echo e(now()->toDateString()); ?>">

                        <div class="mb-3">
                            <label for="task_id" class="form-label">Tugas Terkait (Opsional)</label>
                            <select class="form-control" id="task_id" name="task_id">
                                <option value="">-- Tidak terkait tugas spesifik --</option>
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($task->id); ?>" <?php if(old('task_id') == $task->id): echo 'selected'; endif; ?>>
                                        <?php echo e($task->title); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="form-text text-muted">Pilih tugas jika aktivitas harian Anda adalah bagian dari
                                penyelesaian tugas tersebut.</small>
                        </div>

                        <div class="mb-3">
                            <label for="tasks_completed" class="form-label">Aktivitas yang Diselesaikan Hari Ini <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control <?php $__errorArgs = ['tasks_completed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tasks_completed"
                                name="tasks_completed" rows="5" required><?php echo e(old('tasks_completed')); ?></textarea>
                            <small class="form-text text-muted">Gunakan baris baru untuk memisahkan setiap
                                aktivitas.</small>
                            <?php $__errorArgs = ['tasks_completed'];
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
                            <label for="description" class="form-label">Deskripsi Tambahan / Kendala (Opsional)</label>
                            <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" name="description"
                                rows="3"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
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

                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Perhatian: Logbook yang sudah disimpan tidak dapat
                            diubah kembali.
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="<?php echo e(route('pemagang.logbook.index')); ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Logbook</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pemagang.layoutspemagang.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pemagang/logbook/create.blade.php ENDPATH**/ ?>