<?php $__env->startSection('title', 'Buat Task'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0">Buat Task</h1>
            <small class="text-muted">
                Peserta: <?php echo e($participant->nama); ?> (<?php echo e($participant->nisnim); ?>) • Pembimbing: <?php echo e($internship->supervisor->nama); ?>

            </small>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('pembimbing.task.index', $participant)); ?>" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Periksa kembali input Anda:</div>
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($e); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('pembimbing.task.store', $participant)); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label">Judul Task</label>
                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Ringkasan pekerjaan"><?php echo e(old('description')); ?></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Task</label>
                        <input type="date" name="task_date" value="<?php echo e(old('task_date', now()->toDateString())); ?>" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <?php $statuses = ['Dikerjakan','Revisi','Selesai']; ?>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st); ?>" <?php if(old('status','Dikerjakan')===$st): echo 'selected'; endif; ?>><?php echo e($st); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Feedback (opsional)</label>
                        <input type="text" name="feedback" value="<?php echo e(old('feedback')); ?>" class="form-control">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo e(route('pembimbing.task.index', $participant)); ?>" class="btn btn-light">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pembimbing.layoutspembimbing.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/pembimbing/task/create.blade.php ENDPATH**/ ?>