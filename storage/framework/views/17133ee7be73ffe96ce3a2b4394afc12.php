<?php $__env->startSection('title', 'Penugasan Peserta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0">Penugasan untuk: <?php echo e($participant->nama); ?></h1>
            <small class="text-muted">NISNIM: <?php echo e($participant->nisnim); ?> • Email: <?php echo e($participant->email ?? '-'); ?></small>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('pembimbing.peserta.show', $participant)); ?>" class="btn btn-secondary btn-sm">Detail Peserta</a>
            <a href="<?php echo e(route('pembimbing.task.create', $participant)); ?>" class="btn btn-primary btn-sm">Buat Task</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th style="width:200px;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($tasks->firstItem() + $i); ?></td>
                                <td><?php echo e(optional($t->task_date)->format('d M Y')); ?></td>
                                <td><?php echo e($t->title); ?></td>
                                <td>
                                    <span class="badge
                                        <?php if($t->status === 'Selesai'): ?> bg-success
                                        <?php elseif($t->status === 'Revisi'): ?> bg-warning
                                        <?php else: ?> bg-secondary <?php endif; ?>">
                                        <?php echo e($t->status); ?>

                                    </span>
                                </td>
                                <td class="text-truncate" style="max-width:280px;"><?php echo e($t->feedback ?? '-'); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('pembimbing.task.edit', [$participant, $t])); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="<?php echo e(route('pembimbing.task.destroy', [$participant, $t])); ?>" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus task ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada task.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if($tasks->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($tasks->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pembimbing.layoutspembimbing.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/pembimbing/task/index.blade.php ENDPATH**/ ?>