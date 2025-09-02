@extends('admin.layoutsadmin.main')
@section('permohonan-active', 'active')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Permohonan Magang</h1>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-success h-100 py-2 text-center">
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
                <div class="card card-hover border-left-warning h-100 py-2 text-center">
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
                <div class="card card-hover border-left-danger shadow h-100 py-2 text-center">
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
                <div class="card card-hover border-left-primary shadow h-100 py-2 text-center">
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

        <div class="card mb-4">
            <div class="row align-items-end">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Pencarian</label>
                    <input type="text" class="form-control" placeholder="Cari nama atau asal institusi...">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option value="">Pilih status...</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="pending">Pending</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Institusi</label>
                    <select name="id_instansi" class="form-control @error('id_instansi')
                        is-invalid @enderror"
                        id="">
                        <option value="">--Pilih Instansi--</option>
                        @forelse ($searchinstansis as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_instansi }}</option>
                        @empty
                            <option value="">Tidak Ada Instansi</option>
                        @endforelse
                    </select>
                    @error('id_instansi')   
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Filter</button>
                        <button class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.permohonan.tambah') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>


    </div>

@endsection
