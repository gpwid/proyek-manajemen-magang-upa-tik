<?php $__env->startSection('title', 'Penugasan'); ?>
<?php $__env->startSection('penugasan-active', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Penugasan</h1>
        </div>
        <a href="<?php echo e(route('admin.penugasan.create')); ?>" class="btn btn-primary mb-2">
            <i class="fa-solid fa-file-circle-plus"></i> Penugasan Baru
        </a>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "<?php echo e(session('success')); ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <div class="row">
            <?php $__currentLoopData = $kanbanColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm bg-light border-0 h-100">
                        <div class="card-header bg-transparent py-2 border-0">
                            <h6 class="m-0 font-weight-bold text-primary d-flex justify-content-between align-items-center">
                                <?php echo e($status); ?>

                                <?php
                                    $badgeColor = match ($status) {
                                        'Dikerjakan' => 'bg-info',
                                        'Revisi' => 'bg-warning',
                                        'Selesai' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                ?>
                                <span class="badge <?php echo e($badgeColor); ?> rounded-pill"><?php echo e($tasks->count()); ?></span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="card-title font-weight-bold mb-1"><?php echo e($task->title); ?></h6>
                                            <a href="<?php echo e(route('admin.penugasan.edit', $task->id)); ?>"
                                                class="btn btn-sm btn-light py-0 px-1">
                                                <i class="fas fa-pencil-alt text-gray-500"></i>
                                            </a>
                                        </div>
                                        <p class="card-text small text-muted">
                                            <?php echo e(Str::limit($task->description, 100)); ?>

                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="fas fa-user fa-sm mr-2"></i>
                                                <?php echo e($task->participant->nama); ?>

                                            </small>
                                            <small class="text-muted">
                                                <?php echo e($task->task_date->format('d M')); ?>

                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card bg-light border-dashed">
                                    <div class="card-body text-center text-muted py-5">
                                        <small>Tidak ada tugas</small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Semua Tugas (Tabel)</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-4 mb-3">
                        <label for="institute_filter">Filter Instansi</label>
                        <select id="institute_filter" class="form-control">
                            <option value="">Semua Instansi</option>
                            <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($institute->id); ?>"><?php echo e($institute->nama_instansi); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status_filter">Filter Status</label>
                        <select id="status_filter" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <?php $__currentLoopData = ['Dikerjakan', 'Revisi', 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sp); ?>"><?php echo e($sp); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tasksTable" width="100%">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Peserta</th>
                                <th>Instansi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <?php if(session('success')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "<?php echo e(session('success')); ?>",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php endif; ?>

    
    <script>
        $(function() {
            const table = $('#tasksTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route('admin.penugasan.data')); ?>',
                    data: function(d) {
                        d.institute_id = $('#institute_filter').val();
                        d.status = $('#status_filter').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'participant_name',
                        name: 'participant.nama'
                    },
                    {
                        data: 'institute_name',
                        name: 'participant.institute.nama_instansi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'task_date',
                        name: 'task_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
                }
            });

            // Event listener untuk filter instansi
            $('#institute_filter').on('change', function() {
                table.ajax.reload();
            });

            $('#status_filter').on('change', function() {
                table.ajax.reload();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/penugasan/index.blade.php ENDPATH**/ ?>