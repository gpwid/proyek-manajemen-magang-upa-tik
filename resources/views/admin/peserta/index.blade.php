@extends('admin.layoutsadmin.main')
@section('peserta-active', 'active')
@section('title', 'Peserta')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Peserta</h1>
        </div>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Peserta</h1>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-users fa-2x text-primary"></i>
                            </span>
        <!-- Statistik -->
        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-users fa-2x text-primary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['total'] }}</div>
                        <div class="text-muted">Total Pemagang</div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['total'] }}</div>
                        <div class="text-muted">Total Pemagang</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-info h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-person fa-2x text-info"></i>
                            </span>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-info h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-person fa-2x text-info"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['laki_laki'] }}</div>
                        <div class="text-muted">Total Pemagang Laki-Laki</div>
                    </div>
                </div>
            </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['laki_laki'] }}</div>
                        <div class="text-muted">Total Pemagang Laki-Laki</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-pink h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-person-dress fa-2x text-pink"></i>
                            </span>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card card-hover border-left-pink h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-person-dress fa-2x text-pink"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['perempuan'] }}</div>
                        <div class="text-muted">Total Pemagang Perempuan</div>
                    </div>
                </div>
            </div>
        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $stats['perempuan'] }}</div>
                        <div class="text-muted">Total Pemagang Perempuan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                {{-- Filter + Search + Tambah --}}
                <div class="row align-items-end g-3 mb-3">
        <div class="card">
            <div class="card-body">
                {{-- Filter + Search + Tambah --}}
                <div class="row align-items-end g-3 mb-3">

                    {{-- Filter --}}
                    <div class="col-md-4">
                        <label class="form-label">Filter Jenis Kelamin</label>
                        <select id="jenis_kelamin_filter" class="form-control">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    {{-- Filter --}}
                    <div class="col-md-4">
                        <label class="form-label">Filter Jenis Kelamin</label>
                        <select id="jenis_kelamin_filter" class="form-control">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    {{-- Search (beri padding-end supaya tidak nempel tombol) --}}
                    <div class="col-md-5 pe-lg-3">
                        <label class="form-label">Pencarian</label>
                        <div class="search-wrapper">
                            <span class="search-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <circle cx="11" cy="11" r="7" stroke="#94A3B8" stroke-width="2" />
                                    <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="#94A3B8"
                                        stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input type="text" id="searchbox" class="form-control search-control" placeholder="Cari...">
                            <button type="button" id="clearSearch" class="clear-btn" aria-label="Bersihkan">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M18 6L6 18M6 6l12 12" stroke="#9CA3AF" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- Search (beri padding-end supaya tidak nempel tombol) --}}
                    <div class="col-md-5 pe-lg-3">
                        <label class="form-label">Pencarian</label>
                        <div class="search-wrapper">
                            <span class="search-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <circle cx="11" cy="11" r="7" stroke="#94A3B8" stroke-width="2" />
                                    <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="#94A3B8"
                                        stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input type="text" id="searchbox" class="form-control search-control" placeholder="Cari...">
                            <button type="button" id="clearSearch" class="clear-btn" aria-label="Bersihkan">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M18 6L6 18M6 6l12 12" stroke="#9CA3AF" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Tombol (kolom tersendiri, selalu rata kanan) --}}
                    <div class="col-md-3 text-lg-end">
                        <label class="form-label d-none d-lg-block">&nbsp;</label>
                        <a class="btn btn-primary px-3 shadow-sm w-100 w-lg-auto"
                            href="{{ route('admin.peserta.create') }}">
                            <i class="fas fa-plus me-1"></i> Tambah Peserta
                        </a>
                    </div>
                </div>
                    {{-- Tombol (kolom tersendiri, selalu rata kanan) --}}
                    <div class="col-md-3 text-lg-end">
                        <label class="form-label d-none d-lg-block">&nbsp;</label>
                        <a class="btn btn-primary px-3 shadow-sm w-100 w-lg-auto"
                            href="{{ route('admin.peserta.create') }}">
                            <i class="fas fa-plus me-1"></i> Tambah Peserta
                        </a>
                    </div>
                </div>

                {{-- Export Button --}}
                <div class="d-flex flex-wrap gap-3 mb-2">
                    <button id="btnExportExcel" type="button" class="btn btn-success">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </button>
                    <button id="btnExportPdf" type="button" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </button>
                </div>
                {{-- Export Button --}}
                <div class="d-flex flex-wrap gap-3 mb-2">
                    <button id="btnExportExcel" type="button" class="btn btn-success">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </button>
                    <button id="btnExportPdf" type="button" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </button>
                </div>

                <!-- Tabel -->
                <table id="participants-table" class="display table table-striped table-hover align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NISN/NIM</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
                <!-- Tabel -->
                <table id="participants-table" class="display table table-striped table-hover align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NISN/NIM</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
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

{{-- ====== STYLE ====== --}}
<style>
    /* Card & layout */
    .card .card-body { padding: 1.25rem 1.25rem 1rem; }
    #participants-table_wrapper .row { align-items: center; }
    .card .card-body { padding: 1.25rem 1.25rem 1rem; }
    #participants-table_wrapper .row { align-items: center; }

    /* Searchbar — samakan dengan Select2 */
    .search-wrapper { position: relative; }
    .search-wrapper { position: relative; }
    .search-icon {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; pointer-events: none;
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; pointer-events: none;
    }
    .clear-btn {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        border: 0; background: transparent; display: none; padding: 0; line-height: 0;
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        border: 0; background: transparent; display: none; padding: 0; line-height: 0;
    }
    .search-control {
        height: 42px !important; border-radius: 12px !important; border: 1px solid #e5e7eb !important;
        padding-left: 2.6rem !important; padding-right: 2.4rem !important; box-shadow: 0 1px 2px rgba(16,24,40,.04) !important;
        height: 42px !important; border-radius: 12px !important; border: 1px solid #e5e7eb !important;
        padding-left: 2.6rem !important; padding-right: 2.4rem !important; box-shadow: 0 1px 2px rgba(16,24,40,.04) !important;
    }
    .search-control::placeholder { color: #9ca3af; }
    .search-control:focus { border-color: #c7d2fe !important; box-shadow: 0 0 0 .2rem rgba(99,102,241,.2) !important; }
    .search-control::placeholder { color: #9ca3af; }
    .search-control:focus { border-color: #c7d2fe !important; box-shadow: 0 0 0 .2rem rgba(99,102,241,.2) !important; }

    /* Select2 look */
    .select2-container .select2-selection--single {
        height: 42px !important; border-radius: 12px !important; border: 1px solid #e5e7eb !important;
        padding: .35rem .75rem; box-shadow: 0 1px 2px rgba(16,24,40,.04);
        height: 42px !important; border-radius: 12px !important; border: 1px solid #e5e7eb !important;
        padding: .35rem .75rem; box-shadow: 0 1px 2px rgba(16,24,40,.04);
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow { top: 7px !important; right: 10px !important; }
    .select2-container--default .select2-selection--single .select2-selection__arrow { top: 7px !important; right: 10px !important; }

    /* DataTables length (Show entries) container */
    .dataTables_length { display: flex; align-items: center; gap: .5rem; }
    .dataTables_length label { font-weight: 600; color: #64748b; margin-bottom: 0; }
    .dataTables_length .select2 { min-width: 120px; }
    .dataTables_length:after { content: 'data'; margin-left: .35rem; color: #64748b; font-weight: 600; }
    @media (max-width:768px){ .dataTables_length:after { display: none; } }
    .dataTables_length { display: flex; align-items: center; gap: .5rem; }
    .dataTables_length label { font-weight: 600; color: #64748b; margin-bottom: 0; }
    .dataTables_length .select2 { min-width: 120px; }
    .dataTables_length:after { content: 'data'; margin-left: .35rem; color: #64748b; font-weight: 600; }
    @media (max-width:768px){ .dataTables_length:after { display: none; } }

    /* Table polish */
    #participants-table { border-radius: 14px; overflow: hidden; }
    #participants-table thead th { background: #f8fafc; font-weight: 700; border-bottom: 1px solid #e9ecef; }
    #participants-table tbody td { vertical-align: middle; }
    #participants-table.table-hover tbody tr:hover { background: #f6f9ff; }
    .text-nowrap { white-space: nowrap; }
    #participants-table { border-radius: 14px; overflow: hidden; }
    #participants-table thead th { background: #f8fafc; font-weight: 700; border-bottom: 1px solid #e9ecef; }
    #participants-table tbody td { vertical-align: middle; }
    #participants-table.table-hover tbody tr:hover { background: #f6f9ff; }
    .text-nowrap { white-space: nowrap; }

    /* Gender badges */
    .badge-pill {
        border-radius: 999px;
        padding: .35rem .6rem;
        font-weight: 600;
    }

    .badge-gender-l {
        background: #e0f2fe;
        color: #0369a1;
        background: #e0f2fe;
        color: #0369a1;
    }

    .badge-gender-p {
        background: #fce7f3;
        color: #be185d;
        background: #fce7f3;
        color: #be185d;
    }

    /* Actions */
    .btn-icon { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }
    .btn-icon + .btn-icon { margin-left: .35rem; }
    .btn-icon { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }
    .btn-icon + .btn-icon { margin-left: .35rem; }

    /* Info & Pagination */
    .dataTables_info { color: #6b7280; }
    .dataTables_paginate { text-align: right; }
    .dataTables_info { color: #6b7280; }
    .dataTables_paginate { text-align: right; }
    .dataTables_paginate .paginate_button {
        border: 1px solid #e5e7eb !important; border-radius: 9999px !important;
        padding: .48rem .9rem !important; margin: 0 .2rem !important;
        background: #fff !important; color: #334155 !important; font-weight: 600 !important;
        border: 1px solid #e5e7eb !important; border-radius: 9999px !important;
        padding: .48rem .9rem !important; margin: 0 .2rem !important;
        background: #fff !important; color: #334155 !important; font-weight: 600 !important;
    }
    .dataTables_paginate .paginate_button.previous::before { content: '‹'; margin-right: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.next::after { content: '›'; margin-left: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.previous::before { content: '‹'; margin-right: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.next::after { content: '›'; margin-left: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button:hover {
        background: #eef2ff !important; border-color: #c7d2fe !important; color: #3730a3 !important;
        background: #eef2ff !important; border-color: #c7d2fe !important; color: #3730a3 !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .08);
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: .55;
        cursor: default !important;
    }
</style>

{{-- ====== SCRIPTS ====== --}}
@section('scripts')
    @if (session('sukses'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('sukses') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    @if (session('sukses'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('sukses') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    {{-- Select2 (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Select2 (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            const sel = '#participants-table';
            /** Ambil instance jika sudah ada, kalau belum baru init */
            let table = $.fn.DataTable.isDataTable(sel) ?
                $(sel).DataTable() :
                $(sel).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.peserta.data') !!}',
                        data: d => {
                            d.jenis_kelamin = $('#jenis_kelamin_filter').val();
                            d.searchbox = $('#searchbox').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nisnim',
                            name: 'nisnim',
                            className: 'text-nowrap'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin',
                            render: (data, type) => {
                                if (type === 'display') {
                                    const isL = (data || '').toUpperCase() === 'L';
                                    return `<span class="badge badge-pill ${isL?'badge-gender-l':'badge-gender-p'}">${isL?'Laki-laki':'Perempuan'}</span>`;
                                }
                                return data;
                            }
                        },
                        {
                            data: 'jurusan',
                            name: 'jurusan'
                        },
                        {
                            data: 'kontak_peserta',
                            name: 'kontak_peserta',
                            className: 'text-nowrap'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            className: 'text-nowrap'
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'Semua']
                    ],
                    dom: "<'row align-items-center mb-2'<'col-md-6'l><'col-md-6'>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row mt-2'<'col-md-4'i><'col-md-8'p>>",
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                        lengthMenu: 'Tampilkan _MENU_',
                        paginate: {
                            previous: 'Sebelumnya',
                            next: 'Berikutnya'
                        }
                    },
                    responsive: true,
                    autoWidth: false,
                    initComplete: function() {
                        // Hindari re-init Select2
                        const $len = $('.dataTables_length select');
                        if ($len.data('select2')) $len.select2('destroy');
                        $len.select2({
                            minimumResultsForSearch: Infinity,
                            width: 'style'
                        });
    <script>
        $(function() {
            const sel = '#participants-table';
            /** Ambil instance jika sudah ada, kalau belum baru init */
            let table = $.fn.DataTable.isDataTable(sel) ?
                $(sel).DataTable() :
                $(sel).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.peserta.data') !!}',
                        data: d => {
                            d.jenis_kelamin = $('#jenis_kelamin_filter').val();
                            d.searchbox = $('#searchbox').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nisnim',
                            name: 'nisnim',
                            className: 'text-nowrap'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin',
                            render: (data, type) => {
                                if (type === 'display') {
                                    const isL = (data || '').toUpperCase() === 'L';
                                    return `<span class="badge badge-pill ${isL?'badge-gender-l':'badge-gender-p'}">${isL?'Laki-laki':'Perempuan'}</span>`;
                                }
                                return data;
                            }
                        },
                        {
                            data: 'jurusan',
                            name: 'jurusan'
                        },
                        {
                            data: 'kontak_peserta',
                            name: 'kontak_peserta',
                            className: 'text-nowrap'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            className: 'text-nowrap'
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'Semua']
                    ],
                    dom: "<'row align-items-center mb-2'<'col-md-6'l><'col-md-6'>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row mt-2'<'col-md-4'i><'col-md-8'p>>",
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                        lengthMenu: 'Tampilkan _MENU_',
                        paginate: {
                            previous: 'Sebelumnya',
                            next: 'Berikutnya'
                        }
                    },
                    responsive: true,
                    autoWidth: false,
                    initComplete: function() {
                        // Hindari re-init Select2
                        const $len = $('.dataTables_length select');
                        if ($len.data('select2')) $len.select2('destroy');
                        $len.select2({
                            minimumResultsForSearch: Infinity,
                            width: 'style'
                        });

                        const $jk = $('#jenis_kelamin_filter');
                        if ($jk.data('select2')) $jk.select2('destroy');
                        $jk.select2({
                            placeholder: 'Pilih jenis kelamin',
                            allowClear: true,
                            width: '100%'
                        });
                    }
                });
                        const $jk = $('#jenis_kelamin_filter');
                        if ($jk.data('select2')) $jk.select2('destroy');
                        $jk.select2({
                            placeholder: 'Pilih jenis kelamin',
                            allowClear: true,
                            width: '100%'
                        });
                    }
                });

            // ===== Filter & Search (pastikan tidak double-bind) =====
            $('#jenis_kelamin_filter').off('change').on('change', () => table.ajax.reload());
            $('#searchbox').off('keyup input');
            $('#searchbox').on('keyup', () => table.ajax.reload());
            $('#searchbox').on('input', function() {
                $('#clearSearch').toggle(this.value.length > 0);
            });
            $('#clearSearch').off('click').on('click', function() {
                $('#searchbox').val('');
                $(this).hide();
                table.ajax.reload();
            }).hide();
            // ===== Filter & Search (pastikan tidak double-bind) =====
            $('#jenis_kelamin_filter').off('change').on('change', () => table.ajax.reload());
            $('#searchbox').off('keyup input');
            $('#searchbox').on('keyup', () => table.ajax.reload());
            $('#searchbox').on('input', function() {
                $('#clearSearch').toggle(this.value.length > 0);
            });
            $('#clearSearch').off('click').on('click', function() {
                $('#searchbox').val('');
                $(this).hide();
                table.ajax.reload();
            }).hide();

            // Tooltip sekali saja
            if (typeof bootstrap !== 'undefined') {
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
            }
            // Tooltip sekali saja
            if (typeof bootstrap !== 'undefined') {
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
            }

            // ===== Export buttons (hindari double-bind) =====
            function buildQuery() {
                return $.param({
                    jenis_kelamin: $('#jenis_kelamin_filter').val() || '',
                    search: $('#searchbox').val() || ''
                });
            }
            // ===== Export buttons (hindari double-bind) =====
            function buildQuery() {
                return $.param({
                    jenis_kelamin: $('#jenis_kelamin_filter').val() || '',
                    search: $('#searchbox').val() || ''
                });
            }

            $('#btnExportExcel').off('click').on('click', function() {
                const qs = buildQuery();
                window.location = "{{ route('admin.peserta.export.excel') }}" + (qs ? ('?' + qs) : '');
            });
            $('#btnExportExcel').off('click').on('click', function() {
                const qs = buildQuery();
                window.location = "{{ route('admin.peserta.export.excel') }}" + (qs ? ('?' + qs) : '');
            });

            $('#btnExportPdf').off('click').on('click', function() {
                const qs = buildQuery();
                window.location = "{{ route('admin.peserta.export.pdf') }}" + (qs ? ('?' + qs) : '');
            });
        });
    </script>

            $('#btnExportPdf').off('click').on('click', function() {
                const qs = buildQuery();
                window.location = "{{ route('admin.peserta.export.pdf') }}" + (qs ? ('?' + qs) : '');
            });
        });
    </script>

@endsection