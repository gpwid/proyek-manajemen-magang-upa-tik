@extends('admin.layoutsadmin.main')
@section('title', 'QR Code Absensi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">QR Code Absensi Hari Ini</h1>
        <p class="mb-4">QR Code akan diperbarui setiap pukul 12 malam dan hanya menampilkan QR code yang sesuai dengan
            waktu saat ini.</p>

        @if ($currentQrType && $currentQrUrl)
            <div class="text-center mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">QR Code untuk {{ $currentQrType }}</h6>
                        <small class="text-muted">Berlaku dari {{ $currentQrStart->format('H:i') }} hingga
                            {{ $currentQrEnd->format('H:i') }}</small>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->generate($currentQrUrl) !!}
                        <p class="mt-3 mb-0">Pindai untuk {{ $currentQrType }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center">
                <p class="text-muted">Saat ini tidak ada QR Code yang aktif.</p>
            </div>
        @endif
    </div>
@endsection
