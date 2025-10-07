<?php use Illuminate\Support\Str; ?>



<?php $__env->startSection('title', 'Detail Peserta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Detail Peserta</h1>
        <a href="<?php echo e(route('pembimbing.peserta.index')); ?>" class="btn btn-sm btn-secondary">Kembali</a>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3"><?php echo e($participant->nama); ?></h5>
                    <div class="mb-2"><strong>NISNIM:</strong> <?php echo e($participant->nisnim); ?></div>
                    <div class="mb-2"><strong>Email:</strong> <?php echo e($participant->email ?? '-'); ?></div>
                    <div class="mb-2">
                        <strong>Pembimbing:</strong>
                        <?php
                            $firstIntern = $participant->internships->first();
                            $pembimbing = optional($firstIntern?->supervisor)->nama;
                        ?>
                        <?php echo e($pembimbing ?? '-'); ?>

                    </div>
                    <hr>
                    <div class="mb-2"><strong>Total Logbook:</strong> <?php echo e($participant->logbooks->count()); ?></div>
                    <div class="mb-2"><strong>Total Absen:</strong> <?php echo e($participant->attendances->count()); ?></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="pesertaTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="logbook-tab" data-bs-toggle="tab" data-bs-target="#tab-logbook" type="button" role="tab">
                                Logbook
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="absen-tab" data-bs-toggle="tab" data-bs-target="#tab-absen" type="button" role="tab">
                                Riwayat Absen
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">
                        
                        <div class="tab-pane fade show active" id="tab-logbook" role="tabpanel">
                            <?php if($participant->logbooks->isEmpty()): ?>
                                <div class="text-muted">Belum ada logbook.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">#</th>
                                                <th>Tanggal</th>
                                                <th>Tugas/Dikerjakan</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $participant->logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($i+1); ?></td>
                                                    <td><?php echo e(optional($lb->date)->format('d M Y') ?? '-'); ?></td>
                                                    <td><?php echo e(Str::limit($lb->tasks_completed, 80)); ?></td>
                                                    <td><?php echo e(Str::limit($lb->description, 120)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="tab-pane fade" id="tab-absen" role="tabpanel">
                            <?php if($participant->attendances->isEmpty()): ?>
                                <div class="text-muted">Belum ada riwayat absen.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">#</th>
                                                <th>Tanggal</th>
                                                <th>Masuk</th>
                                                <th>Pulang</th>
                                                <th>IP Masuk</th>
                                                <th>IP Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $participant->attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($i+1); ?></td>
                                                    <td><?php echo e(optional($ab->date)->format('d M Y') ?? '-'); ?></td>
                                                    <td><?php echo e(optional($ab->check_in_time)->format('H:i') ?? '-'); ?></td>
                                                    <td><?php echo e(optional($ab->check_out_time)->format('H:i') ?? '-'); ?></td>
                                                    <td><?php echo e($ab->check_in_ip_address ?? '-'); ?></td>
                                                    <td><?php echo e($ab->check_out_ip_address ?? '-'); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div> <!-- tab-content -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pembimbing.layoutspembimbing.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/pembimbing/peserta/show.blade.php ENDPATH**/ ?>