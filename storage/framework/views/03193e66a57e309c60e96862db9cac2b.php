<?php $__env->startSection('title', 'Peserta Bimbingan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-3">Peserta Bimbingan</h1>

    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:420px;">
            <input type="text" name="q" value="<?php echo e($q); ?>" class="form-control" placeholder="Cari nama/NISNIM/email">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama</th>
                            <th>NISNIM</th>
                            <th>Email</th>
                            <th class="text-center">Logbook</th>
                            <th class="text-center">Absen</th>
                            <th style="width:120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($participants->firstItem() + $i); ?></td>
                                <td><?php echo e($p->nama); ?></td>
                                <td><?php echo e($p->nisnim); ?></td>
                                <td><?php echo e($p->email ?? '-'); ?></td>
                                <td class="text-center"><?php echo e($p->logbooks_count); ?></td>
                                <td class="text-center"><?php echo e($p->attendances_count); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('pembimbing.peserta.show', $p)); ?>" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada peserta bimbingan.</td>
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

<?php echo $__env->make('pembimbing.layoutspembimbing.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pembimbing/peserta/index.blade.php ENDPATH**/ ?>