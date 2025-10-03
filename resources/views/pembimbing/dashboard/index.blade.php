@extends('pembimbing.layoutspembimbing.main')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $greeting }}, Pembimbing! 👋</h1>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-hover border-left-primary h-100 py-2 text-center">
                <div class="card-body align-content-center">
                    <div class="mb-2">
                        <div class="d-flex align-items-center rounded-circle">
                            <i class="fa-solid fa-users fa-2x text-primary"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Total Binaan</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalBinaan }}</div>
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
                                <div class="text-muted">Total Tugas</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalTugas }}</div>
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
                            <i class="fa-solid fa-check-circle fa-2x text-success"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Tugas Selesai</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $tugasSelesai }}</div>
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
                            <i class="fa-solid fa-hourglass-half fa-2x text-warning"></i>
                            <div class="flex-grow-1 ms-4 text-start">
                                <div class="text-muted">Tugas Outstanding</div>
                                <div class="h4 mb-0 font-weight-bold text-dark">{{ $tugasOutstanding }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Baris chart --}}
    <div class="row mt-1">
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa-solid fa-users"></i> Statistik Gender Binaan
                    </h6>
                </div>
                <div class="card-body">
                    <div id="genderPieChart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa-solid fa-clipboard-check"></i> Status Tugas Binaan
                    </h6>
                </div>
                <div class="card-body">
                    <div id="taskStatusBarChart"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Akses cepat --}}
    <div class="row mt-1">
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa-solid fa-bolt"></i> Akses Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('pembimbing.peserta.index') }}" class="btn btn-primary btn-lg btn-icon-split">
                            <span class="text"><i class="fas fa-users"></i> Lihat Peserta Binaan</span>
                        </a>
                        {{-- Tambahan akses cepat lain jika perlu --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Data dari controller (format mirip admin dashboard)
    var genderData = @json($genderChartData);
    var statusData = @json($statusChartData);

    // Pie gender (mengikuti pola ApexCharts di dashboard admin)
    var options = {
        series: genderData.series,
        labels: genderData.labels,
        chart: { type: 'pie', height: 250 },
        colors: ['#4e73df', '#d63384'],
        responsive: [{
            breakpoint: 480,
            options: { chart: { width: 200 }, legend: { position: 'bottom' } }
        }]
    };
    new ApexCharts(document.querySelector("#genderPieChart"), options).render();

    // Bar status tugas
    var barChartOptions = {
        series: [{ name: 'Jumlah Tugas', data: statusData.series }],
        chart: { type: 'bar', height: 350 },
        plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
        dataLabels: { enabled: true },
        xaxis: { categories: statusData.labels, title: { text: 'Jumlah Tugas' } },
        tooltip: { y: { formatter: function(val){ return val + " tugas" } } }
    };
    new ApexCharts(document.querySelector("#taskStatusBarChart"), barChartOptions).render();
</script>
@endpush
