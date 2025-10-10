@extends('atasan.layoutsatasan.main')

@section('title', 'Penugasan')
@section('penugasan-active', 'active')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Penugasan</h1>
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
                    url: '{{ route('atasan.penugasan.data') }}',
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
