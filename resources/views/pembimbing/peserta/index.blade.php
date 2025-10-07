@extends('pembimbing.layoutspembimbing.main')

@section('title', 'Peserta Bimbingan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Peserta Bimbingan</h1>

    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:420px;">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama/NISNIM/email">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama</th>
                            <th>NISNIM</th>
                            <th>Email</th>
                            <th class="text-center">Logbook</th>
                            <th class="text-center">Absen</th>
                            <th style="width:120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $p)
                            <tr>
                                <td>{{ $participants->firstItem() + $i }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nisnim }}</td>
                                <td>{{ $p->email ?? '-' }}</td>
                                <td class="text-center">{{ $p->logbooks_count }}</td>
                                <td class="text-center">{{ $p->attendances_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('pembimbing.peserta.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada peserta bimbingan.</td>
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
