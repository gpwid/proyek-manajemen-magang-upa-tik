@extends('pemagang.layoutspemagang.main')

@section('title', 'Dashboard Pemagang')
@section('dashboard-active', 'active')

@section('content')

    @php
        // Ambil user dari guard admin jika ada, kalau tidak pakai default
        $user = Auth::user();
        $name = $user?->name ?? 'Guest';

    @endphp

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $greeting }}, {{ $name }}! 😍</h1>
        </div>

    </div>

@endsection
