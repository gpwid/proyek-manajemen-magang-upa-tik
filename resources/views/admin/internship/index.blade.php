@extends('admin.layoutsadmin.main')
@section('internship-active', 'active')
@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Data Magang</h1>
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

            <div class="col-xl-4 col-md-12 mb-4">
                <div class="card card-hover border-left-success h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-check fa-2x text-success"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalAktif }}</div>
                        <div class="text-muted">Aktif</div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-12 mb-4">
                <div class="card card-hover border-left-secondary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-user-xmark fa-2x text-secondary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalNonaktif }}</div>
                        <div class="text-muted">Nonaktif</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-12 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-file-invoice fa-2x text-primary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalSemua }}</div>
                        <div class="text-muted">Total Data Magang</div>
                    </div>
                </div>
            </div>

        </div>

        <form id="filterForm" method="GET" action="{{ route('admin.internship.index') }}">
            <div class="card mb-4">
                <div class="row align-items-end p-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_magang" class="form-select">
                            <option value="">Semua status…</option>
                            @foreach (['Aktif', 'Nonaktif'] as $st)
                                <option value="{{ $st }}" @selected(request('status_magang') === $st)>{{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </form>

        <div class="d-flex justify-start gap-2 mb-4">
            <a href="{{ route('admin.internship.create') }}"
                class="d-none d-sm-inline-block btn btn-lg btn-primary rounded-3 shadow-sm"><i
                    class="fa-solid fa-file-circle-plus text-white"></i> Data Magang Baru
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="internshipTable" class="table">
                        <thead>
                            <tr>
                                <th>ID Magang</th>
                                <th>Pembimbing</th>
                                <th>ID Permohonan</th>
                                <th>Peserta</th>
                                <th>Status</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
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
            const table = $('#internshipTable').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.internship.data') }}',
                    data: function(d) {
                        d.status_magang = $('select[name="status_magang"]').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'pembimbing',
                        name: 'pembimbing',
                    },
                    {
                        data: 'permohonan',
                        name: 'permohonan',
                    },
                    {
                        data: 'peserta',
                        name: 'peserta',
                    },
                    {
                        data: 'status_magang',
                        name: 'status_magang'
                    },
                    {
                        data: 'tgl_mulai',
                        name: 'tgl_mulai'
                    },
                    {
                        data: 'tgl_selesai',
                        name: 'tgl_selesai'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [4, 'desc']
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
                }
            });

            $('#filterForm').find('select, input, textarea').on('change input', function() {
                table.ajax.reload();
            });

            $('#resetBtn').on('click', function(e) {
                e.preventDefault();
                $('#filterForm')[0].reset();
                table.ajax.reload();
            });
        });
    </script>
@endpush
