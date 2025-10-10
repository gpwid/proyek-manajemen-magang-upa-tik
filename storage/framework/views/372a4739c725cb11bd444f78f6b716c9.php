<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Absensi - <?php echo e($participant->nama); ?></title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        body{ font-size:12px; color:#333; }
        h2{ margin:0 0 6px 0; }
        table{ width:100%; border-collapse:collapse; margin-top:8px; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; vertical-align:top; }
        th{ background:#f2f2f2; text-align:left; }
        .muted{ color:#777; }
    </style>
</head>
<body>
    <h2>Riwayat Absensi</h2>
    <p style="margin:0 0 10px 0;">
        <strong>Peserta:</strong> <?php echo e($participant->nama); ?> (<?php echo e($participant->nisnim); ?>)<br>
        <strong>Instansi:</strong> <?php echo e($participant->institute->nama_instansi ?? '-'); ?>

    </p>

    <table>
        <thead>
            <tr>
                <th style="width:110px;">Tanggal</th>
                <th style="width:90px;">Status</th>
                <th style="width:85px;">Check-in</th>
                <th style="width:85px;">Check-out</th>
                <th>IP Masuk</th>
                <th>IP Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(optional($ab->date)->format('d-m-Y')); ?></td>
                    <td><?php echo e($ab->status ?? '-'); ?></td>
                    <td>
                        <?php if($ab->check_in_time): ?>
                            <?php echo e(\Illuminate\Support\Carbon::parse($ab->check_in_time)->timezone('Asia/Jakarta')->format('H:i:s')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($ab->check_out_time): ?>
                            <?php echo e(\Illuminate\Support\Carbon::parse($ab->check_out_time)->timezone('Asia/Jakarta')->format('H:i:s')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($ab->check_in_ip_address ?? '-'); ?></td>
                    <td><?php echo e($ab->check_out_ip_address ?? '-'); ?></td>
                    <td><?php echo e($ab->note ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="text-align:center;" class="muted">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\laragon\www\magang\resources\views/admin/peserta/exports/attendance_pdf.blade.php ENDPATH**/ ?>