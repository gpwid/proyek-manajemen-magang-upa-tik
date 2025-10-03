@extends('admin.layoutsadmin.main')
@section('title', 'QR Code Absensi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">QR Code Absensi Hari Ini</h1>
        <p class="mb-4">Tampilkan kode ini kepada peserta untuk melakukan absensi. Kode akan diperbarui secara otomatis.
        </p>

        {{-- Alert untuk menampilkan timer --}}
        <div class="alert alert-info text-center">
            <h5 class="mb-0">
                <i class="fas fa-hourglass-start mr-2"></i>
                QR Code baru akan dibuat dalam
                <span id="countdown-timer" class="font-weight-bold">120</span> detik
            </h5>
        </div>

        <div class="row">
            <div class="col-md-6 text-center mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">QR Code untuk Check-In</h6>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->generate($checkInUrl) !!}
                        <p class="mt-3 mb-0">Pindai untuk Absen Masuk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-success">QR Code untuk Check-Out</h6>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->generate($checkOutUrl) !!}
                        <p class="mt-3 mb-0">Pindai untuk Absen Pulang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 120; // Atur waktu awal ke 120 detik
            const timerElement = document.getElementById('countdown-timer');

            // Fungsi untuk memperbarui timer setiap detik
            const countdown = setInterval(function() {
                timeLeft--;
                timerElement.textContent = timeLeft;

                // Jika waktu habis, hentikan interval dan refresh halaman
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerElement.textContent = 'Memuat ulang...';
                    location.reload(); // Refresh halaman untuk mendapatkan QR code baru
                }
            }, 1000); // Jalankan setiap 1000ms = 1 detik
        });
    </script>
@endpush
