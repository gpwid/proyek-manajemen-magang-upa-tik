@extends('pembimbing.layoutspembimbing.main') {{-- atau layouts.main sesuai project-mu --}}

@section('title', 'Peserta Bimbingan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Peserta Bimbingan</h1>

    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:420px;">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama/NIM/email">
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
                            <th>NIM</th>
                            <th>Email</th>
                            <th class="text-center">Logbook</th>
                            <th class="text-center">Absen</th>
                            <th style="width:120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($internships as $i => $intern)
                            @php $p = $intern->participant; @endphp
                            <tr>
                                <td>{{ $internships->firstItem() + $i }}</td>
                                <td>{{ $p?->name ?? '-' }}</td>
                                <td>{{ $p?->student_id ?? '-' }}</td>
                                <td>{{ $p?->email ?? '-' }}</td>
                                <td class="text-center">{{ $p?->logbooks_count ?? 0 }}</td>
                                <td class="text-center">{{ $p?->attendances_count ?? 0 }}</td>
                                <td class="text-end">
                                    @if($p)
                                        <a href="{{ route('pembimbing.peserta.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                    @else
                                        <span class="text-muted">Data peserta hilang</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada peserta bimbingan aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($internships->hasPages())
            <div class="card-footer">
                {{ $internships->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
