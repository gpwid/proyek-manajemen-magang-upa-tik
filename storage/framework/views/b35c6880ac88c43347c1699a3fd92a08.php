<?php $__env->startSection('title', 'Logbook Harian'); ?>
<?php $__env->startSection('logbook-active', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Logbook Harian Saya</h1>
            <a href="<?php echo e(route('pemagang.logbook.create')); ?>" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Isi Logbook Hari Ini
            </a>
        </div>

        <?php if($errors->any()): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "<?php echo e($errors->first()); ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Logbook</h6>
            </div>
            <div class="card-body">
                <table id="logbookTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aktivitas yang Diselesaikan</th>
                            <th>Deskripsi/Kendala</th>
                            <th>Tugas Terkait</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<style>
    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #usersTable_wrapper .row {
        align-items: center;
    }

    .datatable {
        border-radius: 14px;
        overflow: hidden;
    }

    .datatable thead th {
        background: #f8fafc;
        font-weight: 700;
        border-bottom: 1px solid #e9ecef;
    }

    .datatable tbody td {
        vertical-align: middle;
    }

    .datatable.table-hover tbody tr:hover {
        background: #f6f9ff;
    }

    .dataTables_filter label {
        font-weight: 600;
        color: #64748b;
    }

    .dataTables_filter input {
        height: 42px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        padding-left: 2.6rem !important;
        padding-right: 1rem !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04) !important;
        background:
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="%2394A3B8" stroke-width="2"/><line x1="16.65" y1="16.65" x2="21" y2="21" stroke="%2394A3B8" stroke-width="2" stroke-linecap="round"/></svg>') no-repeat 12px center / 18px 18px;
    }

    .dataTables_filter input::placeholder {
        color: #9ca3af;
    }

    .dataTables_filter input:focus {
        border-color: #c7d2fe !important;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
    }

    .dataTables_length {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .dataTables_length label {
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0;
    }

    .dataTables_length:after {
        content: 'data';
        margin-left: .35rem;
        color: #64748b;
        font-weight: 600;
    }

    @media (max-width:768px) {
        .dataTables_length:after {
            display: none;
        }
    }

    .select2-container .select2-selection--single {
        height: 42px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        padding: .35rem .75rem;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px !important;
        right: 10px !important;
    }

    .dataTables_paginate {
        text-align: right;
    }

    .dataTables_paginate .paginate_button {
        border: 1px solid #e5e7eb !important;
        border-radius: 9999px !important;
        padding: .48rem .9rem !important;
        margin: 0 .2rem !important;
        background: #fff !important;
        color: #334155 !important;
        font-weight: 600 !important;
    }

    .dataTables_paginate .paginate_button.previous::before {
        content: '‹';
        margin-right: .35rem;
        font-weight: 800;
    }

    .dataTables_paginate .paginate_button.next::after {
        content: '›';
        margin-left: .35rem;
        font-weight: 800;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button:hover {
        background: #eef2ff !important;
        border-color: #c7d2fe !important;
        color: #3730a3 !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .08);
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: .55;
        cursor: default !important;
    }
</style>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: "<?php echo e(session('success')); ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php endif; ?>
            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: "<?php echo e(session('error')); ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
            <?php endif; ?>

            $('#logbookTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route('pemagang.logbook.data')); ?>',
                columns: [{
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'tasks_completed',
                        name: 'tasks_completed'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        defaultContent: '-'
                    },
                    {
                        data: 'related_task',
                        name: 'related_task',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('pemagang.layoutspemagang.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/pemagang/logbook/index.blade.php ENDPATH**/ ?>