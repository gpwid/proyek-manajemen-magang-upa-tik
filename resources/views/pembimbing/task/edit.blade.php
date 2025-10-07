@extends('pembimbing.layoutspembimbing.main')

@section('title', 'Edit Task')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0">Edit Task</h1>
            <small class="text-muted">
                Peserta: {{ $participant->nama }} ({{ $participant->nisnim }})
            </small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pembimbing.task.index', $participant) }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Periksa kembali input Anda:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pembimbing.task.update', [$participant, $task]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Task</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Task</label>
                        <input type="date" name="task_date" value="{{ old('task_date', optional($task->task_date)->toDateString()) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        @php $statuses = ['Dikerjakan','Revisi','Selesai']; @endphp
                        <select name="status" class="form-select" required>
                            @foreach($statuses as $st)
                                <option value="{{ $st }}" @selected(old('status', $task->status)===$st)>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Feedback (opsional)</label>
                        <input type="text" name="feedback" value="{{ old('feedback', $task->feedback) }}" class="form-control">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('pembimbing.task.index', $participant) }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
