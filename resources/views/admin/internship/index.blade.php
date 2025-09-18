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


        {{-- Filter --}}
        <form id="filterForm" method="GET" action="{{ route('admin.internship.index') }}">
            <div class="card mb-4">
                <div class="row align-items-end p-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_magang" class="form-select">
                            <option value="">Semua status…</option>
                            @foreach (['Aktif', 'Nonaktif'] as $st)
                                <option value="{{ $st }}" @selected(request('status_magang') === $st)>{{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Instansi</label>
                        <select name="id_institute" class="form-select">
                            <option value="">Semua instansi…</option>
                            @foreach ($searchinstitutes as $ins)
                                <option value="{{ $ins->id }}" @selected(request('id_institute') == $ins->id)>
                                    {{ $ins->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-body">
                {{-- Tombol Export --}}
                <div class="d-flex justify-content-start gap-2 mb-3">
                    <a href="{{ route('admin.internship.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-file-circle-plus"></i> Data Magang Baru
                    </a>
                    <button id="btnExportExcel" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
                    <button id="btnExportPdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
                </div>

                <table id="internshipTable" class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Surat</th>
                            <th>Instansi</th>
                            <th>Pembimbing</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

@endsection

{{-- ====== STYLE ====== --}}
{{-- ====== STYLE ====== --}}
<style>
    /* Card & layout */
    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #internshipTable_wrapper .row {
        align-items: center;
    }

    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #internshipTable_wrapper .row {
        #internshipTable_wrapper .row {
            align-items: center;
        }

        .card .card-body {
            padding: 1.25rem 1.25rem 1rem;
        }

        #internshipTable_wrapper .row {
            align-items: center;
        }

        /* Searchbar — samakan dengan Select2 */
        .search-wrapper {
            position: relative;
        }

        .search-wrapper {
            position: relative;
        }

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
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            display: none;
            padding: 0;
            line-height: 0;
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
            padding-left: 2.6rem !important;
            padding-right: 2.4rem !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04) !important;
            height: 42px !important;
            border-radius: 12px !important;
            border: 1px solid #e5e7eb !important;
            padding-left: 2.6rem !important;
            padding-right: 2.4rem !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04) !important;
            height: 42px !important;
            border-radius: 12px !important;
            border: 1px solid #e5e7eb !important;
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

        .search-control::placeholder {
            color: #9ca3af;
        }

        .search-control::placeholder {
            color: #9ca3af;
        }

        .search-control:focus {
            border-color: #c7d2fe !important;
            box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
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
            height: 42px !important;
            border-radius: 12px !important;
            border: 1px solid #e5e7eb !important;
            padding: .35rem .75rem;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 7px !important;
            right: 10px !important;
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

            /* Table polish */
            #internshipTable {
                border-radius: 14px;
                overflow: hidden;
            }

            #internshipTable thead th {
                background: #f8fafc;
                font-weight: 700;
                border-bottom: 1px solid #e9ecef;
            }

            #internshipTable tbody td {
                vertical-align: middle;
            }

            #internshipTable.table-hover tbody tr:hover {
                background: #f6f9ff;
            }

            .text-nowrap {
                white-space: nowrap;
            }

            #internshipTable {
                #internshipTable {
                    border-radius: 14px;
                    overflow: hidden;
                }

                #internshipTable thead th {
                    background: #f8fafc;
                    font-weight: 700;
                    border-bottom: 1px solid #e9ecef;
                }

                #internshipTable tbody td {
                    vertical-align: middle;
                }

                #internshipTable.table-hover tbody tr:hover {
                    background: #f6f9ff;
                }

                .text-nowrap {
                    white-space: nowrap;
                }

                #internshipTable {
                    border-radius: 14px;
                    overflow: hidden;
                }

                #internshipTable thead th {
                    #internshipTable thead th {
                        background: #f8fafc;
                        font-weight: 700;
                        border-bottom: 1px solid #e9ecef;
                    }

                    #internshipTable tbody td {
                        #internshipTable tbody td {
                            vertical-align: middle;
                        }

                        #internshipTable.table-hover tbody tr:hover {
                            #internshipTable.table-hover tbody tr:hover {
                                background: #f6f9ff;
                            }

                            .text-nowrap {
                                white-space: nowrap;
                            }

                            /* Gender badges */
                            .badge-pill {
                                border-radius: 999px;
                                padding: .35rem .6rem;
                                font-weight: 600;
                            }

                            .badge-gender-l {
                                background: #e0f2fe !important;
                                color: #0369a1 !important;
                            }

                            .badge-gender-p {
                                background: #fce7f3 !important;
                                color: #be185d !important;
                            }

                            /* Gender badges */
                            .badge-pill {
                                border-radius: 999px;
                                padding: .35rem .6rem;
                                font-weight: 600;
                            }

                            .badge-gender-l {
                                background: #e0f2fe !important;
                                color: #0369a1 !important;
                            }

                            .badge-gender-p {
                                background: #fce7f3 !important;
                                color: #be185d !important;
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

                            /* Info & Pagination */
                            .dataTables_info {
                                color: #6b7280;
                            }

                            .dataTables_paginate {
                                text-align: right;
                            }

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

                            /* Info & Pagination */
                            .dataTables_info {
                                color: #6b7280;
                            }

                            .dataTables_paginate {
                                text-align: right;
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
                                background: #eef2ff !important;
                                border-color: #c7d2fe !important;
                                color: #3730a3 !important;
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
                        d.id_institute = $('select[name="id_institute"]').val(); // ← filter instansi
                    }
                },
                columns: [{
                        data: null,
                        name: 'rownum',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'no_surat',
                        name: 'no_surat'
                    }, // ← No. Surat
                    {
                        data: 'instansi',
                        name: 'instansi'
                    }, // ← Nama Instansi
                    {
                        data: 'pembimbing',
                        name: 'pembimbing'
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
                    },
                ],
                order: [
                    [0, 'desc']
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
                }
            });

            $('#filterForm').find('select').on('change', () => table.ajax.reload());

            function buildQuery() {
                const params = {
                    status_magang: $('select[name="status_magang"]').val(),
                    id_institute: $('select[name="id_institute"]').val(),
                };
                Object.keys(params).forEach(k => {
                    if (!params[k]) delete params[k];
                });
                return new URLSearchParams(params).toString();
            }

            $('#btnExportExcel').on('click', function(e) {
                e.preventDefault();
                const qs = buildQuery();
                window.location.href = '{{ route('admin.internship.export.excel') }}' + (qs ? '?' + qs :
                    '');
            });
            $('#btnExportPdf').on('click', function(e) {
                e.preventDefault();
                const qs = buildQuery();
                window.location.href = '{{ route('admin.internship.export.pdf') }}' + (qs ? '?' + qs : '');
            });
        });
    </script>
@endpush
