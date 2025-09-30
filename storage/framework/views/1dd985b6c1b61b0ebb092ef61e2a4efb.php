<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('dashboard-active', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo e($greeting); ?>, User! 😍</h1>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body align-content-center">
                        <div class="mb-2">
                            <div class="d-flex align-items-center rounded-circle"><i
                                    class="fa-solid fa-users fa-2x text-primary"></i>
                                <div class="flex-grow-1 ms-4 text-start">
                                    <div class="text-muted">Total Pemagang</div>
                                    <div class="h4 mb-0 font-weight-bold text-dark"><?php echo e($totalPemagang); ?></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-info h-100 py-2 text-center">
                    <div class="card-body align-content-center">
                        <div class="mb-2">
                            <div class="d-flex align-items-center rounded-circle"><i
                                    class="fa-solid fa-list-check fa-2x text-info"></i>
                                <div class="flex-grow-1 ms-4 text-start">
                                    <div class="text-muted">Total Penugasan</div>
                                    <div class="h4 mb-0 font-weight-bold text-dark"><?php echo e($totalPenugasan); ?></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-warning h-100 py-2 text-center">
                    <div class="card-body align-content-center">
                        <div class="mb-2">
                            <div class="d-flex align-items-center rounded-circle"><i
                                    class="fa-solid fa-file-lines fa-2x text-warning"></i>
                                <div class="flex-grow-1 ms-4 text-start">
                                    <div class="text-muted">Permohonan Pending</div>
                                    <div class="h4 mb-0 font-weight-bold text-dark"><?php echo e($permohonanPending); ?></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-success h-100 py-2 text-center">
                    <div class="card-body align-content-center">
                        <div class="mb-2">
                            <div class="d-flex align-items-center rounded-circle"><i
                                    class="fa-solid fa-users fa-2x text-success"></i>
                                <div class="flex-grow-1 ms-4 text-start">
                                    <div class="text-muted">Total Pengguna</div>
                                    <div class="h4 mb-0 font-weight-bold text-dark"><?php echo e($totalPengguna); ?></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-1">
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-users"></i> Statistik Gender
                            Pemagang</h6>
                    </div>
                    <div class="card-body">
                        
                        <div id="genderPieChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-bolt"></i> Akses Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            
                            <a href="<?php echo e(route('admin.permohonan.create')); ?>" class="btn btn-primary btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-file-alt"></i> Buat Permohonan Baru</span>
                            </a>

                            
                            <a href="<?php echo e(route('admin.peserta.create')); ?>" class="btn btn-success btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-user-plus"></i> Tambah Peserta Baru</span>
                            </a>

                            
                            <a href="<?php echo e(route('admin.penugasan.index')); ?>" class="btn btn-info btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-tasks"></i> Kelola Penugasan Magang</span>
                            </a>

                            <a href="<?php echo e(route('admin.internship.index')); ?>" class="btn btn-primary btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-tasks"></i> Kelola Magang</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-school"></i> 5 Instansi dengan Permohonan Terbanyak
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="permohonanBarChart"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var genderData = <?php echo json_encode($genderChartData, 15, 512) ?>;

        var options = {

            series: genderData.series,
            labels: genderData.labels,


            chart: {
                type: 'pie',
                height: 250
            },


            colors: ['#4e73df', '#d63384'],


            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#genderPieChart"), options);
        chart.render();

        var permohonanData = <?php echo json_encode($permohonanChartData, 15, 512) ?>;

        var barChartOptions = {
            series: [{
                name: 'Jumlah Pemagang',
                data: permohonanData.series
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    borderRadius: 4
                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: permohonanData.labels,
                title: {
                    text: 'Jumlah Permohonan'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " permohonan"
                    }
                }
            }
        };

        var barChart = new ApexCharts(document.querySelector("#permohonanBarChart"), barChartOptions);
        barChart.render();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\magang\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>