<?php $__env->startSection('title', 'Penugasan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Penugasan</h1>
        <form method="GET" class="ms-auto" style="max-width:420px;">
            <div class="input-group">
                <input type="text" name="q" value="<?php echo e($q); ?>" class="form-control" placeholder="Cari nama/NISNIM/email">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Nama</th>
                            <th>NISNIM</th>
                            <th>Email</th>
                            <th class="text-center">Task</th>
                            <th class="text-center">Logbook</th>
                            <th class="text-center">Absen</th>
                            <th style="width:220px;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($participants->firstItem() + $i); ?></td>
                                <td><?php echo e($p->nama); ?></td>
                                <td><?php echo e($p->nisnim); ?></td>
                                <td><?php echo e($p->email ?? '-'); ?></td>
                                <td class="text-center"><?php echo e($p->tasks_count); ?></td>
                                <td class="text-center"><?php echo e($p->logbooks_count); ?></td>
                                <td class="text-center"><?php echo e($p->attendances_count); ?></td>
                                <td class="text-end d-flex gap-2 justify-content-end">
                                    <a class="btn btn-sm btn-outline-primary" href="<?php echo e(route('pembimbing.task.create', $p)); ?>">
                                        Beri Task
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary" href="<?php echo e(route('pembimbing.task.index', $p)); ?>">
                                        Lihat Task
                                    </a>
                                    <a class="btn btn-sm btn-light" href="<?php echo e(route('pembimbing.peserta.show', $p)); ?>">
                                        Detail Peserta
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">Tidak ada peserta bimbingan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if($participants->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($participants->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pembimbing.layoutspembimbing.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pembimbing/task/participants.blade.php ENDPATH**/ ?>