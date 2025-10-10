<?php $__env->startSection('title', 'Detail Peserta'); ?>
<?php $__env->startSection('peserta-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800">Detail Peserta</h1>
        <div class="d-flex flex-wrap gap-2">
            
            <a href="<?php echo e(route('admin.attendance.manual.create', ['participant_id' => $participant->id])); ?>"
               class="btn btn-warning">
                <i class="fas fa-clipboard-check me-1"></i> Input Izin/Sakit
            </a>

            <a href="<?php echo e(route('admin.peserta.edit', $participant->id)); ?>" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="<?php echo e(route('admin.peserta.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-3">
        
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i> Informasi Peserta
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <div class="info-item">
                                <label class="info-label">Nama Lengkap</label>
                                <div class="info-value"><?php echo e($participant->nama); ?></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">NIK</label>
                                <div class="info-value"><?php echo e($participant->nik); ?></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">NISN / NIM</label>
                                <div class="info-value"><?php echo e($participant->nisnim); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">Jenis Kelamin</label>
                                <div class="info-value">
                                    <?php if($participant->jenis_kelamin === 'L'): ?>
                                        Laki-laki
                                    <?php elseif($participant->jenis_kelamin === 'P'): ?>
                                        Perempuan
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">Sekolah/Instansi Asal</label>
                                <div class="info-value"><?php echo e($participant->institute->nama_instansi ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">Jurusan</label>
                                <div class="info-value"><?php echo e($participant->jurusan ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="info-item">
                                <label class="info-label">Tahun Aktif</label>
                                <div class="info-value"><?php echo e($participant->tahun_aktif ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-item">
                                <label class="info-label">Kontak Peserta</label>
                                <div class="info-value"><?php echo e($participant->kontak_peserta ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="info-item">
                                <label class="info-label">Alamat</label>
                                <div class="info-value"><?php echo e($participant->alamat_asal ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="info-item">
                                <label class="info-label">Wali yang dapat dihubungi</label>
                                <div class="info-value">
                                    <?php echo e($participant->nama_wali ?? '-'); ?> (<?php echo e($participant->kontak_wali ?? '-'); ?>)
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Keterangan</label>
                                <div class="info-value">
                                    <?php if($participant->keterangan): ?>
                                        <div class="bg-light p-3 rounded"><?php echo e($participant->keterangan); ?></div>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada keterangan</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div> 
                </div>
            </div>
        </div>

        
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <ul class="nav nav-tabs" id="detailTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="logbook-tab" data-bs-toggle="tab" data-bs-target="#tab-logbook" type="button" role="tab">
                                Logbook
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="absen-tab" data-bs-toggle="tab" data-bs-target="#tab-absen" type="button" role="tab">
                                Riwayat Absensi
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">

                        
                        <div class="tab-pane fade show active" id="tab-logbook" role="tabpanel" aria-labelledby="logbook-tab">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <h5 class="mb-2 mb-md-0">Total Logbook: <?php echo e($participant->logbooks->count()); ?></h5>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-success btn-sm"
                                       href="<?php echo e(route('admin.peserta.logbook.export.excel', $participant->id)); ?>">
                                        <i class="fas fa-file-excel me-1"></i> Export Excel
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="<?php echo e(route('admin.peserta.logbook.export.pdf', $participant->id)); ?>">
                                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                                    </a>
                                </div>
                            </div>

                            <?php if($participant->logbooks->isEmpty()): ?>
                                <div class="text-muted">Belum ada logbook.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:80px;">Tanggal</th>
                                                <th style="min-width:240px;">Tugas/Dikerjakan</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $participant->logbooks->sortByDesc('date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(optional($lb->date)->format('d M Y') ?? '-'); ?></td>
                                                    <td><?php echo e($lb->tasks_completed); ?></td>
                                                    <td><?php echo e($lb->description); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="tab-pane fade" id="tab-absen" role="tabpanel" aria-labelledby="absen-tab">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <h5 class="mb-2 mb-md-0">Total Absen: <?php echo e($participant->attendances->count()); ?></h5>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-success btn-sm"
                                       href="<?php echo e(route('admin.peserta.absen.export.excel', $participant->id)); ?>">
                                        <i class="fas fa-file-excel me-1"></i> Export Excel
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="<?php echo e(route('admin.peserta.absen.export.pdf', $participant->id)); ?>">
                                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                                    </a>
                                </div>
                            </div>

                            <?php if($participant->attendances->isEmpty()): ?>
                                <div class="text-muted">Belum ada riwayat absen.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:120px;">Tanggal</th>
                                                <th style="width:110px;">Status</th>
                                                <th style="width:100px;">Check-in</th>
                                                <th style="width:100px;">Check-out</th>
                                                <th>IP Masuk</th>
                                                <th>IP Pulang</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $participant->attendances->sortByDesc('date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $badge = $ab->status === 'Hadir' ? 'bg-success'
                                                            : ($ab->status === 'Izin' ? 'bg-warning'
                                                            : ($ab->status === 'Sakit' ? 'bg-info' : 'bg-secondary'));
                                                ?>
                                                <tr>
                                                    <td><?php echo e(\Carbon\Carbon::parse($ab->date)->translatedFormat('d M Y')); ?></td>
                                                    <td><span class="badge <?php echo e($badge); ?>"><?php echo e($ab->status); ?></span></td>
                                                    <td><?php echo e($ab->check_in_time ? \Carbon\Carbon::parse($ab->check_in_time)->format('H:i:s') : '-'); ?></td>
                                                    <td><?php echo e($ab->check_out_time ? \Carbon\Carbon::parse($ab->check_out_time)->format('H:i:s') : '-'); ?></td>
                                                    <td><?php echo e($ab->check_in_ip_address ?? '-'); ?></td>
                                                    <td><?php echo e($ab->check_out_ip_address ?? '-'); ?></td>
                                                    <td><?php echo e($ab->note ?? '-'); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div> 
                </div>
            </div>
        </div>

    </div> 
</div>


<style>
    .info-item { margin-bottom: .75rem; }
    .info-label {
        font-size: .9rem; font-weight: 600; color: #6c757d;
        margin-bottom: .25rem; display: block;
    }
    .info-value { font-size: 1rem; color: #343a40; min-height: 1.2rem; }
    .card { border-radius: .5rem; }
    .card-header { border-bottom: none; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/peserta/detail.blade.php ENDPATH**/ ?>