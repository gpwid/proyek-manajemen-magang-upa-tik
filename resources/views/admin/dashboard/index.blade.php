@extends('admin.layoutsadmin.main')

@section('dashboard-active', 'active')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $greeting }}, User! 😍</h1>
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
                                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPemagang }}</div>
                                    {{-- <div class="small text-success">Haloo</div> --}}
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
                                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPenugasan }}</div>
                                    {{-- <div class="small text-success">Haloo</div> --}}
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
                                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $permohonanPending }}</div>
                                    {{-- <div class="small text-success">Haloo</div> --}}
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
                                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPengguna }}</div>
                                    {{-- <div class="small text-success">Haloo</div> --}}
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
                        {{-- Ini adalah "kanvas" tempat chart akan digambar oleh JavaScript --}}
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
                            {{-- Tombol 1: Tambah Permohonan Baru --}}
                            <a href="{{ route('admin.permohonan.tambah') }}" class="btn btn-primary btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-file-alt"></i> Buat Permohonan Baru</span>
                            </a>

                            {{-- Tombol 2: Tambah Peserta Baru --}}
                            <a href="{{ route('admin.peserta.create') }}" class="btn btn-success btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-user-plus"></i> Tambah Peserta Baru</span>
                            </a>

                            {{-- Tombol 3: Kelola Data Magang --}}
                            <a href="{{ route('admin.internship.index') }}" class="btn btn-info btn-lg btn-icon-split">
                                <span class="text"><i class="fas fa-tasks"></i> Kelola Penugasan Magang</span>
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

@endsection
@push('scripts')
    <script>
        // Ambil data yang kita kirim dari controller
        var genderData = @json($genderChartData);

        var options = {
            // Tentukan data series (angka) dan labels (nama kategori)
            series: genderData.series,
            labels: genderData.labels,

            // Tipe chart yang kita inginkan
            chart: {
                type: 'pie',
                height: 250 // Atur tinggi chart
            },

            // Atur warna untuk setiap bagian pie
            colors: ['#d63384', '#4e73df'], // Biru untuk Laki-laki, Kuning untuk Perempuan

            // Pengaturan tambahan agar terlihat bagus
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

        // Buat instance chart baru dan render di dalam div #genderPieChart
        var chart = new ApexCharts(document.querySelector("#genderPieChart"), options);
        chart.render();

        var permohonanData = @json($permohonanChartData);

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
                    horizontal: true, // Membuatnya menjadi bar chart horizontal
                    borderRadius: 4
                }
            },
            dataLabels: {
                enabled: true // Menampilkan angka di dalam batang
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
@endpush
