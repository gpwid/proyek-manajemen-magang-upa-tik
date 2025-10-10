@extends('admin.layoutsadmin.main')

@section('title', 'Penugasan')
@section('penugasan-active', 'active')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Penugasan</h1>
        </div>
        <a href="{{ route('admin.penugasan.create') }}" class="btn btn-primary mb-2">
            <i class="fa-solid fa-file-circle-plus"></i> Penugasan Baru
        </a>

        @if ($errors->any())
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timer: 4000
                });
            </script>
        @endif

        @if (session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 4000
                });
            </script>
        @endif

        <div class="row">
            @foreach ($kanbanColumns as $status => $tasks)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm bg-light border-0 h-100">
                        <div class="card-header bg-transparent py-2 border-0">
                            <h6 class="m-0 font-weight-bold text-primary d-flex justify-content-between align-items-center">
                                {{ $status }}
                                @php
                                    $badgeColor = match ($status) {
                                        'Dikerjakan' => 'bg-info',
                                        'Revisi' => 'bg-warning',
                                        'Selesai' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeColor }} rounded-pill">{{ $tasks->count() }}</span>
                            </h6>
                        </div>
                        <div class="card-body">
                            @forelse ($tasks as $task)
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="card-title font-weight-bold mb-1">{{ $task->title }}</h6>
                                            <a href="{{ route('admin.penugasan.edit', $task->id) }}"
                                                class="btn btn-sm btn-light py-0 px-1">
                                                <i class="fas fa-pencil-alt text-gray-500"></i>
                                            </a>
                                        </div>
                                        <p class="card-text small text-muted">
                                            {{ Str::limit($task->description, 100) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="fas fa-user fa-sm mr-2"></i>
                                                {{ $task->participant->nama }}
                                            </small>
                                            <small class="text-muted">
                                                {{ $task->task_date->format('d M') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card bg-light border-dashed">
                                    <div class="card-body text-center text-muted py-5">
                                        <small>Tidak ada tugas</small>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card shadow mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Semua Tugas (Tabel)</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-4 mb-3">
                        <label for="institute_filter">Filter Instansi</label>
                        <select id="institute_filter" class="form-control">
                            <option value="">Semua Instansi</option>
                            @foreach ($institutes as $institute)
                                <option value="{{ $institute->id }}">{{ $institute->nama_instansi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status_filter">Filter Status</label>
                        <select id="status_filter" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            @foreach (['Dikerjakan', 'Revisi', 'Selesai'] as $sp)
                                <option value="{{ $sp }}">{{ $sp }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tasksTable" width="100%">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Peserta</th>
                                <th>Instansi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
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
    .card .card-body {
        padding: 1.25rem 1.25rem 1rem;
    }

    #usersTable_wrapper .row {
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
    {{-- Sweet Alert untuk notifikasi sukses --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif

    {{-- Skrip Inisialisasi DataTables --}}
    <script>
        $(function() {
            const table = $('#tasksTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.penugasan.data') }}',
                    data: function(d) {
                        d.institute_id = $('#institute_filter').val();
                        d.status = $('#status_filter').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'participant_name',
                        name: 'participant.nama'
                    },
                    {
                        data: 'institute_name',
                        name: 'participant.institute.nama_instansi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'task_date',
                        name: 'task_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
                }
            });

            // Event listener untuk filter instansi
            $('#institute_filter').on('change', function() {
                table.ajax.reload();
            });

            $('#status_filter').on('change', function() {
                table.ajax.reload();
            });
        });
    </script>
@endpush
