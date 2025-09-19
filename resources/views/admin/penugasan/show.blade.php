@extends('admin.layoutsadmin.main')

@section('penugasan-active', 'active')
@section('title', 'Detail Tugas')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Tugas</h1>
            <div>
                <a href="{{ route('admin.penugasan.edit', $task->id) }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-pencil-alt fa-sm"></i> Edit Tugas
                </a>
                <a href="{{ route('admin.penugasan.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $task->title }}</h6>
                    </div>
                    <div class="card-body">
                        <h5>Deskripsi Tugas</h5>
                        <p class="text-gray-800" style="white-space: pre-wrap;">{{ $task->description }}</p>
                        <hr>
                        <h5>Feedback dari Pembimbing</h5>
                        @if ($task->feedback)
                            <p class="text-gray-800" style="white-space: pre-wrap;">{{ $task->feedback }}</p>
                        @else
                            <p class="text-muted"><i>Belum ada feedback.</i></p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong>Status</strong>
                                @php
                                    $badgeColor = match ($task->status) {
                                        'Dikerjakan' => 'badge-info',
                                        'Revisi' => 'badge-warning',
                                        'Selesai' => 'badge-success',
                                        default => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeColor }} badge-pill">{{ $task->status }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong>Tanggal Tugas</strong>
                                <span>{{ $task->task_date->format('d F Y') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong>Peserta</strong>
                                <span>{{ $task->participant->nama }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong>Instansi</strong>
                                <span>{{ $task->internship->permohonan->institute->nama_instansi }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong>Pembimbing</strong>
                                <span>{{ $task->internship->supervisor->nama }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
