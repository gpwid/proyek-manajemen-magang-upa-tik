@extends('admin.layoutsadmin.main')
@section('permohonan-active', 'active')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Permohonan</h1>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-check fa-2x text-success"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">24</div>
                        <div class="text-muted">Disetujui</div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-clock fa-2x text-warning"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">8</div>
                        <div class="text-muted">Pending</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">3</div>
                        <div class="text-muted">Ditolak</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-file-invoice fa-2x text-primary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">35</div>
                        <div class="text-muted">Total</div>
                    </div>
                </div>
            </div>

        </div>

        <a href="{{ route('admin.permohonan.tambah') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>


    </div>

@endsection
