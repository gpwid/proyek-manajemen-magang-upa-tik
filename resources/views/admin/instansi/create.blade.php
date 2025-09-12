@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Instansi')
@section('instansi-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Tambah Instansi</h1>
    </div>

    <div class="card shadow col-12 p-4">
        <form action="{{ route('admin.instansi.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Instansi<span class="text-danger">*</span></label>
                <input value="{{ old('nama_instansi') }}" type="text" name="nama_instansi"
                       class="form-control @error('nama_instansi') is-invalid @enderror"
                       placeholder="Masukkan nama instansi">
                @error('nama_instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <input value="{{ old('alamat') }}" type="text" name="alamat"
                       class="form-control @error('alamat') is-invalid @enderror"
                       placeholder="Masukkan alamat">
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary mr-2" href="{{ route('admin.instansi.index') }}">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
