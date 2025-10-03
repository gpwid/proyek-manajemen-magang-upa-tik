@extends('atasan.layoutsatasan.main')
@section('title', 'Dashboard')
@section('dashboard-active', 'active')


@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $greeting }}, User! 😍</h1>
    </div>

    {{-- Kartu statistik --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-hover border-left-primary h-100 py-2 text-center">
                <div class="card-body align-content-center">
                    <div class="mb-2">
                        <div class="d-flex align-items-center rounded-circle">
                            <i class="fa-solid fa-users fa-2x text-primary"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Total Pemagang</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPemagang }}</div>
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
                        <div class="d-flex align-items-center rounded-circle">
                            <i class="fa-solid fa-list-check fa-2x text-info"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Total Penugasan</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPenugasan }}</div>
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
                        <div class="d-flex align-items-center rounded-circle">
                            <i class="fa-solid fa-file-lines fa-2x text-warning"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Permohonan Pending</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $permohonanPending }}</div>
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
                        <div class="d-flex align-items-center rounded-circle">
                            <i class="fa-solid fa-users fa-2x text-success"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Total Pengguna</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalPengguna }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart + Akses Cepat Laporan --}}
    <div class="row mt-1">
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa-solid fa-users"></i> Statistik Gender Pemagang
                    </h6>
                </div>
                <div class="card-body">
                    <div id="genderPieChart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa-solid fa-bolt"></i> Akses Cepat Laporan (PDF & Excel)
                    </h6>
                    {{-- catatan: default tanpa filter --}}
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">

                        {{-- PERMOHONAN --}}
                        <div class="d-flex flex-wrap gap-2">
                            <span class="fw-semibold me-1" style="min-width:140px">Permohonan</span>
                            <div class="ms-auto d-flex flex-wrap gap-2">
                                <a href="{{ route('atasan.permohonan.export.pdf') }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </a>
                                <a href="{{ route('atasan.permohonan.export.excel') }}" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </a>
                            </div>
                        </div>
                        <hr class="my-2">

                        {{-- PESERTA --}}
                        <div class="d-flex flex-wrap gap-2">
                            <span class="fw-semibold me-1" style="min-width:140px">Peserta</span>
                            <div class="ms-auto d-flex flex-wrap gap-2">
                                <a href="{{ route('atasan.peserta.export.pdf') }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </a>
                                <a href="{{ route('atasan.peserta.export.excel') }}" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </a>
                            </div>
                        </div>
                        <hr class="my-2">

                        {{-- PEMBIMBING --}}
                        <div class="d-flex flex-wrap gap-2">
                            <span class="fw-semibold me-1" style="min-width:140px">Pembimbing</span>
                            <div class="ms-auto d-flex flex-wrap gap-2">
                                <a href="{{ route('atasan.pembimbing.export.pdf') }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </a>
                                <a href="{{ route('atasan.pembimbing.export.excel') }}" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </a>
                            </div>
                        </div>
                        <hr class="my-2">

                        {{-- MAGANG --}}
                        <div class="d-flex flex-wrap gap-2">
                            <span class="fw-semibold me-1" style="min-width:140px">Magang</span>
                            <div class="ms-auto d-flex flex-wrap gap-2">
                                <a href="{{ route('atasan.internship.export.pdf') }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </a>
                                <a href="{{ route('atasan.internship.export.excel') }}" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </a>
                            </div>
                        </div>
                        <hr class="my-2">

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Top 5 Instansi --}}
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
    // ===== Pie Gender =====
    var genderData = @json($genderChartData);
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
    new ApexCharts(document.querySelector("#genderPieChart"), options).render();

    // ===== Bar Permohonan per Instansi =====
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
                formatter: val => val + " permohonan"
            }
        }
    };
    new ApexCharts(document.querySelector("#permohonanBarChart"), barChartOptions).render();

</script>
@endpush
