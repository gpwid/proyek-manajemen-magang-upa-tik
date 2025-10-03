@extends('pemagang.layoutspemagang.main')
@section('title', 'Status Absensi')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm text-center">
                    <div class="card-body p-5">
                        @if (isset($isError) && $isError)
                            <i class="fa fa-times-circle fa-4x text-danger mb-3"></i>
                            <h3 class="text-danger">Gagal!</h3>
                        @else
                            <i class="fa fa-check-circle fa-4x text-success mb-3"></i>
                            <h3>Berhasil!</h3>
                        @endif
                        <p class="lead">{{ $message }}</p>
                        <a href="{{ route('pemagang.dashboard.index') }}" class="btn btn-primary mt-3">Kembali ke
                            Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
