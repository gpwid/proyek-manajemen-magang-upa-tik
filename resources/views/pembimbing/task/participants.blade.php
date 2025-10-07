@extends('pembimbing.layoutspembimbing.main')

@section('title', 'Penugasan')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Penugasan</h1>
        <form method="GET" class="ms-auto" style="max-width:420px;">
            <div class="input-group">
                <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama/NISNIM/email">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Nama</th>
                            <th>NISNIM</th>
                            <th>Email</th>
                            <th class="text-center">Task</th>
                            <th class="text-center">Logbook</th>
                            <th class="text-center">Absen</th>
                            <th style="width:220px;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $p)
                            <tr>
                                <td>{{ $participants->firstItem() + $i }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nisnim }}</td>
                                <td>{{ $p->email ?? '-' }}</td>
                                <td class="text-center">{{ $p->tasks_count }}</td>
                                <td class="text-center">{{ $p->logbooks_count }}</td>
                                <td class="text-center">{{ $p->attendances_count }}</td>
                                <td class="text-end d-flex gap-2 justify-content-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('pembimbing.task.create', $p) }}">
                                        Beri Task
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('pembimbing.task.index', $p) }}">
                                        Lihat Task
                                    </a>
                                    <a class="btn btn-sm btn-light" href="{{ route('pembimbing.peserta.show', $p) }}">
                                        Detail Peserta
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Tidak ada peserta bimbingan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($participants->hasPages())
            <div class="card-footer">
                {{ $participants->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
