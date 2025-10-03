<?php $__env->startSection('permohonan-active', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Permohonan Magang</h1>
        </div>

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

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-success h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-check fa-2x text-success"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark"><?php echo e($totalAktif); ?></div>
                        <div class="text-muted">Disetujui</div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-warning h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-clock fa-2x text-warning"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark"><?php echo e($totalProses); ?></div>
                        <div class="text-muted">Proses</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-danger h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark"><?php echo e($totalTolak); ?></div>
                        <div class="text-muted">Ditolak</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-file-invoice fa-2x text-primary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark"><?php echo e($totalSemua); ?></div>
                        <div class="text-muted">Total</div>
                    </div>
                </div>
            </div>

        </div>

        <form id="filterForm" method="GET" action="<?php echo e(route('admin.permohonan.index')); ?>">
            <div class="card mb-4">
                <div class="row align-items-end p-3">

                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua status…</option>
                            <?php $__currentLoopData = ['Proses', 'Aktif', 'Selesai', 'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st); ?>" <?php if(request('status') === $st): echo 'selected'; endif; ?>><?php echo e($st); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Jenis Magang</label>
                        <select name="jenis_magang" class="form-select">
                            <option value="">Semua jenis magang..</option>
                            <?php $__currentLoopData = ['Sekolah', 'MBKM', 'Mandiri']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($jm); ?>" <?php if(request('jenis_magang') === $jm): echo 'selected'; endif; ?>><?php echo e($jm); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filter</button>
                            <a id="resetBtn" class="btn btn-secondary" href="#">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="d-flex justify-start gap-2 mb-4">
            <a href="<?php echo e(route('admin.permohonan.tambah')); ?>"
                class="d-none d-sm-inline-block btn btn-lg btn-primary rounded-3 shadow-sm"><i
                    class="fa-solid fa-file-circle-plus text-white"></i> Permohonan Baru
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permohonanTable" class="table">
                        <thead>
                            <tr>
                                <th>Instansi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Tanggal Surat</th>
                                <th>Pembimbing</th>
                                <th>Kontak</th>
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
    <script>
        $(function() {
            const table = $('#permohonanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route('admin.permohonan.data')); ?>',
                    data: function(d) {
                        d.status = $('select[name="status"]').val();
                        d.jenis_magang = $('select[name="jenis_magang"]').val();
                    }
                },
                columns: [{
                        data: 'instansi',
                        name: 'instansi'
                    },
                    {
                        data: 'jenis_magang',
                        name: 'jenis_magang'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tgl_surat',
                        name: 'tgl_surat'
                    },
                    {
                        data: 'pembimbing_sekolah',
                        name: 'pembimbing_sekolah'
                    },
                    {
                        data: 'kontak_pembimbing',
                        name: 'kontak_pembimbing'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [3, 'desc']
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
                }
            });

            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').on('click', function(e) {
                e.preventDefault();
                $('#filterForm')[0].reset();
                table.ajax.reload();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek-manajemen-magang-upa-tik\resources\views/admin/permohonan/index.blade.php ENDPATH**/ ?>