@extends('admin.layoutsadmin.main')
@section('title', 'Permohonan')
@section('permohonan-active', 'active')
@section('title', 'Permohonan')

@section('content')
    <div class="container-fluid">
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

        {{-- Filter --}}
        <form id="filterForm" method="GET" action="{{ route('admin.permohonan.index') }}">
            <div class="card mb-4">
                <div class="row align-items-end p-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select select2-filter">
                            <option value="">Semua status…</option>
                            @foreach (['Proses', 'Aktif', 'Selesai', 'Ditolak'] as $st)
                                <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Instansi</label>
                        <select name="id_institute" class="form-select select2-filter">
                            <option value="">Semua instansi…</option>
                            @foreach ($searchinstitutes as $ins)
                                <option value="{{ $ins->id }}" @selected(request('id_institute') == $ins->id)>{{ $ins->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Magang</label>
                        <select name="jenis_magang" class="form-select select2-filter">
                            <option value="">Semua jenis magang…</option>
                            @foreach (['Sekolah', 'MBKM', 'Mandiri'] as $jm)
                                <option value="{{ $jm }}" @selected(request('jenis_magang') === $jm)>{{ $jm }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
            <a href="{{ route('admin.permohonan.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-file-circle-plus"></i> Permohonan Baru
            </a>
            <div class="d-flex flex-wrap gap-2">
                <button id="btnExportExcel" type="button" class="btn btn-success"><i class="fas fa-file-excel me-1"></i>
                    Excel</button>
                <button id="btnExportPdf" type="button" class="btn btn-danger"><i class="fas fa-file-pdf me-1"></i>
                    PDF</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="permohonanTable" class="display table table-striped table-hover align-middle datatable"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Instansi</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Tanggal Surat Masuk</th>
                            <th>Pembimbing</th>
                            <th>Kontak</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
@endsection

{{-- ==== STYLE (sama seperti internship, dipisah agar mandiri) ==== --}}
<style>
    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #permohonanTable_wrapper .row {
        align-items: center;
    }

    .datatable {
        border-radius: 14px;
        overflow: hidden;
    }

    .datatable thead th {
        background: #f8fafc;
        font-weight: 700;
        border-bottom: 1px solid #e9ecef;
    }

    .datatable tbody td {
        vertical-align: middle;
    }

    .datatable.table-hover tbody tr:hover {
        background: #f6f9ff;
    }

    .dataTables_filter label {
        font-weight: 600;
        color: #64748b;
    }

    .dataTables_filter input {
        height: 42px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        padding-left: 2.6rem !important;
        padding-right: 1rem !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04) !important;
        background:
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="%2394A3B8" stroke-width="2"/><line x1="16.65" y1="16.65" x2="21" y2="21" stroke="%2394A3B8" stroke-width="2" stroke-linecap="round"/></svg>') no-repeat 12px center / 18px 18px;
    }

    .dataTables_filter input::placeholder {
        color: #9ca3af;
    }

    .dataTables_filter input:focus {
        border-color: #c7d2fe !important;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
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
    {{-- Select2 (kalau belum global di layout) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            // ===== Helpers =====
            function initFilterSelect2() {
                const $filters = $('#filterForm .select2-filter');
                $filters.each(function() {
                    const $el = $(this);
                    if ($el.data('select2')) $el.select2('destroy');
                    $el.select2({
                        placeholder: $el.find('option:first').text() || 'Pilih…',
                        allowClear: true,
                        width: '100%'
                    });
                });
            }

            function initLengthSelect2() {
                const $len = $('.dataTables_length select');
                if ($len.data('select2')) $len.select2('destroy');
                $len.select2({
                    minimumResultsForSearch: Infinity,
                    width: 'style'
                });
            }

            function buildQueryPermohonan() {
                const params = {
                    status: $('select[name="status"]').val() || '',
                    jenis_magang: $('select[name="jenis_magang"]').val() || '',
                    id_institute: $('select[name="id_institute"]').val() || '',
                    q: $('#permohonanTable_filter input').val() || ''
                };
                Object.keys(params).forEach(k => {
                    if (!params[k]) delete params[k];
                });
                return new URLSearchParams(params).toString();
            }

            // ===== DataTable =====
            const permohonanTable = $('#permohonanTable').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.permohonan.data') }}',
                    data: d => {
                        d.status = $('select[name="status"]').val();
                        d.jenis_magang = $('select[name="jenis_magang"]').val();
                        d.id_institute = $('select[name="id_institute"]').val();
                    }
                },
                columns: [{ // No.
                        data: null,
                        name: 'rownum',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
                    },
                    {
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
                        data: 'tgl_suratmasuk',
                        name: 'tgl_suratmasuk'
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
                },
                drawCallback: initLengthSelect2,
                initComplete: function() {
                    initFilterSelect2();
                    initLengthSelect2();
                }
            });

            // ===== Filter -> reload =====
            $('#filterForm').find('select, input, textarea')
                .off('change input')
                .on('change input', () => permohonanTable.ajax.reload());

            // ===== Export =====
            $('#btnExportExcel').off('click').on('click', function(e) {
                e.preventDefault();
                const qs = buildQueryPermohonan();
                window.location.href = '{{ route('admin.permohonan.export.excel') }}' + (qs ? '?' + qs :
                    '');
            });
            $('#btnExportPdf').off('click').on('click', function(e) {
                e.preventDefault();
                const qs = buildQueryPermohonan();
                window.location.href = '{{ route('admin.permohonan.export.pdf') }}' + (qs ? '?' + qs : '');
            });
        });
    </script>
@endpush
