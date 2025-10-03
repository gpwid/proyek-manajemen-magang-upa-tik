@extends('pemagang.layoutspemagang.main')
@section('title', 'Isi Logbook Harian')
@section('logbook-active', 'active')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Isi Logbook Harian</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($todayLogbook)
            <div class="alert alert-success">
                <h4 class="alert-heading"><i class="fa fa-check-circle"></i> Selesai!</h4>
                <p>Anda sudah mengisi logbook untuk hari ini.</p>
                <hr>
                <a href="{{ route('pemagang.logbook.index') }}" class="btn btn-outline-success">Lihat Riwayat Logbook</a>
            </div>
        @else
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Logbook untuk Tanggal
                        {{ now()->translatedFormat('d F Y') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pemagang.logbook.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" value="{{ now()->toDateString() }}">

                        <div class="mb-3">
                            <label for="task_id" class="form-label">Tugas Terkait (Opsional)</label>
                            <select class="form-control" id="task_id" name="task_id">
                                <option value="">-- Tidak terkait tugas spesifik --</option>
                                @foreach ($tasks as $task)
                                    <option value="{{ $task->id }}" @selected(old('task_id') == $task->id)>
                                        {{ $task->title }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih tugas jika aktivitas harian Anda adalah bagian dari
                                penyelesaian tugas tersebut.</small>
                        </div>

                        <div class="mb-3">
                            <label for="tasks_completed" class="form-label">Aktivitas yang Diselesaikan Hari Ini <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('tasks_completed') is-invalid @enderror" id="tasks_completed"
                                name="tasks_completed" rows="5" required>{{ old('tasks_completed') }}</textarea>
                            <small class="form-text text-muted">Gunakan baris baru untuk memisahkan setiap
                                aktivitas.</small>
                            @error('tasks_completed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Tambahan / Kendala (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Perhatian: Logbook yang sudah disimpan tidak dapat
                            diubah kembali.
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('pemagang.logbook.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Logbook</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
