
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pembimbing</title>
    <style>
        *{ font-family: DejaVu Sans, sans-serif; }
        h2{ margin:0 0 10px 0; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; font-size:12px; }
        th{ background:#f2f2f2; text-align:left; }
    </style>
</head>
<body>
    <h2>Data Peserta</h2>
    <?php if($subtitle): ?><p style="margin-top:-6px;"><?php echo e($subtitle); ?></p><?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i+1); ?></td>
                <td><?php echo e($p->nama); ?></td>
                <td><?php echo e($p->nip); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/pembimbing/pdf.blade.php ENDPATH**/ ?>