@extends('pembimbing.layoutspembimbing.main')

@section('title', 'Penugasan Peserta')

@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1 class="h3 mb-0">Penugasan untuk: {{ $participant->nama }}</h1>
                <small class="text-muted">NISNIM: {{ $participant->nisnim }} • Email:
                    {{ $participant->email ?? '-' }}</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('pembimbing.peserta.show', $participant) }}" class="btn btn-secondary btn-sm">Detail
                    Peserta</a>
                <a href="{{ route('pembimbing.task.create', $participant) }}" class="btn btn-primary btn-sm">Buat Task</a>
            </div>
        </div>

        @if ($errors->any())
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timer: 1500
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
                    timer: 1500
                });
            </script>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Feedback</th>
                                <th style="width:200px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $i => $t)
                                <tr>
                                    <td>{{ $tasks->firstItem() + $i }}</td>
                                    <td>{{ optional($t->task_date)->format('d M Y') }}</td>
                                    <td>{{ $t->title }}</td>
                                    <td>
                                        <span
                                            class="badge
                                        @if ($t->status === 'Selesai') bg-success
                                        @elseif($t->status === 'Revisi') bg-warning
                                        @else bg-secondary @endif">
                                            {{ $t->status }}
                                        </span>
                                    </td>
                                    <td class="text-truncate" style="max-width:280px;">{{ $t->feedback ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('pembimbing.task.edit', [$participant, $t]) }}"
                                            class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('pembimbing.task.destroy', [$participant, $t]) }}"
                                            method="POST" class="d-inline" onsubmit="return confirm('Hapus task ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada task.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($tasks->hasPages())
                <div class="card-footer">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
