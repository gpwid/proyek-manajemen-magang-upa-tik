@extends('admin.layoutsadmin.main')
@section('qrcode-active', 'active')
@section('title', 'QR Code Absensi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">QR Code Absensi Hari Ini</h1>
        <div class="alert alert-info">QR Code ini akan otomatis diperbarui setiap 60 detik. Minta peserta untuk memindai kode
            yang paling baru.</div>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">QR Code untuk Check-In</h6>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->generate($checkInUrl) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-success">QR Code untuk Check-Out</h6>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->generate($checkOutUrl) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Auto-refresh halaman setiap 60 detik --}}
    <meta http-equiv="refresh" content="60">
@endsection
