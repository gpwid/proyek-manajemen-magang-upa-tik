@extends('pemagang.layoutspemagang.main')
@section('title', 'Dashboard')
@section('dashboard-active', 'active')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $greeting }}, {{ $user->name }}! 👋</h1>
        </div>

        @if ($activeInternship)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Magang Aktif</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-building mr-1"></i> Instansi</strong>
                            <p class="text-muted">{{ $activeInternship->permohonan->institute->nama_instansi ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-user-tie mr-1"></i> Pembimbing Lapangan</strong>
                            <p class="text-muted">{{ $activeInternship->supervisor->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Mulai</strong>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse($activeInternship->permohonan->tgl_mulai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-calendar-check mr-1"></i> Tanggal Selesai</strong>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse($activeInternship->permohonan->tgl_selesai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Logbook Telah Diisi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $logbookCount }} Hari</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Absensi Hari Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if ($todayAttendance && $todayAttendance->check_in_time)
                                            <span class="text-success">Sudah Check-in</span>
                                            @if ($todayAttendance->check_out_time)
                                                | <span class="text-primary">Sudah Check-out</span>
                                            @endif
                                        @else
                                            <span class="text-danger">Belum Absen</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <div class="row">
                <!-- Tugas Terbaru -->
                @if (!empty($latestTask))
                    <div class="col-xl-12 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Tugas Terbaru</h6>
                                <span
                                    class="small text-muted">{{ $latestTask->task_date ? \Carbon\Carbon::parse($latestTask->task_date)->translatedFormat('d M Y') : '-' }}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-1">{{ $latestTask->title }}</h5>
                                <p class="mb-2 text-muted small">
                                    {{ \Illuminate\Support\Str::limit($latestTask->description, 160) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span
                                            class="badge bg-{{ $latestTask->status === 'Selesai' ? 'success' : ($latestTask->status === 'Dikerjakan' ? 'info' : 'warning') }}">
                                            {{ $latestTask->status }}
                                        </span>
                                        <span class="text-muted ms-2 small">oleh
                                            {{ $latestTask->participant->nama ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h4 class="alert-heading">Tidak Ada Sesi Magang Aktif</h4>
                <p>Saat ini Anda tidak terdaftar dalam sesi magang yang sedang berjalan. Silakan hubungi admin jika ini
                    adalah sebuah kesalahan.</p>
            </div>
        @endif

    </div>
@endsection
