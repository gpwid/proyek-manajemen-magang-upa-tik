@extends('pembimbing.layoutspembimbing.main')
@section('title', 'Daftar Tugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h1 class="h4 mb-0">Tugas untuk: {{ $participant->nama }}</h1>
    <small class="text-muted">NISNIM: {{ $participant->nisnim ?? '-' }}</small>
  </div>
  <a class="btn btn-primary" href="{{ route('pembimbing.task.create', $participant) }}"><i class="fas fa-plus"></i> Buat Tugas</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th style="width:50px">#</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Dibuat</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tasks as $i => $t)
          <tr>
            <td>{{ $tasks->firstItem() + $i }}</td>
            <td>
              <div class="fw-semibold">{{ $t->title }}</div>
              @if($t->description)
                <div class="text-muted small">{{ Str::limit($t->description, 140) }}</div>
              @endif
            </td>
            <td>{{ optional($t->task_date)->format('d M Y') ?? '-' }}</td>
            <td>{{ $t->status }}</td>
            <td>{{ $t->created_at->format('d M Y H:i') }}</td>
          </tr>
          @empty
            <tr><td colspan="5" class="text-center py-4">Belum ada tugas.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  @if ($tasks->hasPages())
    <div class="card-footer">{{ $tasks->links() }}</div>
  @endif
</div>
@endsection
