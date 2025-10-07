@php use Illuminate\Support\Str; @endphp

@extends('pembimbing.layoutspembimbing.main') {{-- atau layouts.main --}}

@section('title', 'Detail Peserta')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Detail Peserta</h1>
        <a href="{{ route('pembimbing.peserta.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">{{ $participant->name }}</h5>
                    <div class="mb-2"><strong>NIM:</strong> {{ $participant->student_id }}</div>
                    <div class="mb-2"><strong>Email:</strong> {{ $participant->email }}</div>
                    <div class="mb-2"><strong>Pembimbing:</strong> {{ optional($participant->supervisor)->name ?? '-' }}</div>
                    <hr>
                    <div class="mb-2"><strong>Total Logbook:</strong> {{ $participant->logbooks->count() }}</div>
                    <div class="mb-2"><strong>Total Absen:</strong> {{ $participant->attendances->count() }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="pesertaTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="logbook-tab" data-bs-toggle="tab" data-bs-target="#tab-logbook" type="button" role="tab">
                                Logbook
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="absen-tab" data-bs-toggle="tab" data-bs-target="#tab-absen" type="button" role="tab">
                                Riwayat Absen
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="tab-logbook" role="tabpanel">
                            @if($participant->logbooks->isEmpty())
                                <div class="text-muted">Belum ada logbook.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">#</th>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Isi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($participant->logbooks as $i => $lb)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ optional($lb->date)->format('d M Y') ?? '-' }}</td>
                                                    <td>{{ $lb->title }}</td>
                                                    <td>{{ Str::limit($lb->content, 120) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="tab-absen" role="tabpanel">
                            @if($participant->attendances->isEmpty())
                                <div class="text-muted">Belum ada riwayat absen.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">#</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Masuk</th>
                                                <th>Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($participant->attendances as $i => $ab)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ optional($ab->attendance_date)->format('d M Y') ?? '-' }}</td>
                                                    <td>{{ strtoupper($ab->status) }}</td>
                                                    <td>{{ optional($ab->check_in)->format('H:i') ?? '-' }}</td>
                                                    <td>{{ optional($ab->check_out)->format('H:i') ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div> <!-- tab-content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
