@extends('admin.layoutsadmin.main')
@section('permohonan-active', 'active')
@section('content')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Permohonan Magang</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>
    @endif

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-hover border-left-success h-100 py-2 text-center">
                <div class="card-body">
                    <div class="mb-2">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                class="fa-solid fa-circle-check fa-2x text-success"></i>
                        </span>
                    </div>
                    <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalAktif }}</div>
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
                    <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalProses }}</div>
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
                    <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalTolak }}</div>
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
                    <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalSemua }}</div>
                    <div class="text-muted">Total</div>
                </div>
            </div>
        </div>

    </div>

    <form id="filterForm" method="GET" action="{{ route('admin.permohonan.index') }}">
        <div class="card mb-4">
            <div class="row align-items-end p-3">

                    {{-- Status (single select, samakan dengan enum di DB) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua status…</option>
                            @foreach (['Proses', 'Aktif', 'Selesai', 'Ditolak'] as $st)
                                <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Magang</label>
                        <select name="jenis_magang" class="form-select">
                            <option value="">Semua jenis magang..</option>
                            @foreach (['Sekolah', 'MBKM', 'Mandiri'] as $jm)
                                <option value="{{ $jm }}" @selected(request('jenis_magang') === $jm)>{{ $jm }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </form>


    <div class="d-flex justify-start gap-2 mb-4 justify-content-between flex-wrap">
        <a href="{{ route('admin.permohonan.tambah') }}"
            class="d-none d-sm-inline-block btn btn-lg btn-primary rounded-3 shadow-sm"><i
                class="fa-solid fa-file-circle-plus text-white"></i> Permohonan Baru
        </a>
        {{-- Export Button --}}
        <div class="d-flex flex-wrap gap-3 mb-2">
            <button id="btnExportExcel" type="button" class="btn btn-success btn-lg">
                <i class="fas fa-file-excel me-1"></i> Excel
            </button>
            <button id="btnExportPdf" type="button" class="btn btn-danger btn-lg">
                <i class="fas fa-file-pdf me-1"></i> PDF
            </button>
        </div>
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

@endsection

<style>
    /* Card & layout */
    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #participants-table_wrapper .row {
        align-items: center;
    }

    /* Searchbar — samakan dengan Select2 */
    .search-wrapper {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        pointer-events: none;
    }

    .clear-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: 0;
        background: transparent;
        display: none;
        padding: 0;
        line-height: 0;
    }

    .search-control {
        height: 42px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        /* >>> ini kunci supaya teks tidak tertimpa ikon */
        padding-left: 2.6rem !important;
        padding-right: 2.4rem !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04) !important;
    }

    .search-control::placeholder {
        color: #9ca3af;
    }

    .search-control:focus {
        border-color: #c7d2fe !important;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
    }



    /* Select2 look */
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

    /* DataTables length (Show entries) container */
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

    .dataTables_length .select2 {
        min-width: 120px;
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

    .dataTables_wrapper {
        overflow-y: hidden !important;
    }

    /* Table polish */
    #participants-table {
        border-radius: 14px;
        overflow: hidden;
        table-layout: auto;
    }

    #participants-table thead th {
        background: #f8fafc;
        font-weight: 700;
        border-bottom: 1px solid #e9ecef;
    }

    #participants-table tbody td {
        vertical-align: middle;
    }

    #participants-table.table-hover tbody tr:hover {
        background: #f6f9ff;
    }

    .text-nowrap {
        white-space: nowrap;
    }

    /* Actions */
    .btn-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .btn-icon+.btn-icon {
        margin-left: .35rem;
    }

    .dataTables_info {
        color: #6b7280;
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


@push('scripts')
    <script>
        $(function() {
            const table = $('#permohonanTable').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.permohonan.data') }}',
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

            $('#filterForm').find('select, input, textarea').on('change input', function() {
                table.ajax.reload();
            });

    // Reset button handler
    $('#resetBtn').on('click', function (e) {
        e.preventDefault();
        $('#filterForm')[0].reset();
        table.ajax.reload();
    });

    // Export functions
    function buildQuery() {
        const params = {
            status: $('select[name="status"]').val(),
            jenis_magang: $('select[name="jenis_magang"]').val(),
            q: $('#permohonanTable_filter input').val()
        };

        // Remove empty parameters
        Object.keys(params).forEach(key => {
            if (!params[key]) delete params[key];
        });

        return new URLSearchParams(params).toString();
    }

    // Export button handlers
    $('#btnExportExcel').on('click', function(e) {
        e.preventDefault();
        const qs = buildQuery();
        const url = '{{ route("admin.permohonan.export.excel") }}' + (qs ? '?' + qs : '');
        console.log('Exporting Excel:', url); // Debug log
        window.location.href = url;
    });

    $('#btnExportPdf').on('click', function(e) {
        e.preventDefault();
        const qs = buildQuery();
        const url = '{{ route("admin.permohonan.export.pdf") }}' + (qs ? '?' + qs : '');
        console.log('Exporting PDF:', url); // Debug log
        window.location.href = url;
    });
});
</script>
@endpush
