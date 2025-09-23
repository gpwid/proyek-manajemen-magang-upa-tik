@extends('admin.layoutsadmin.main')
@section('title', 'Edit Instansi')
@section('instansi-active', 'active')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Form Edit Instansi</h1>
        </div>
        <div class="card shadow title-section-content col-12 p-4">
            <form action="{{ route('admin.instansi.update', $institute->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_instansi" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                    <input id="nama_instansi" type="text" name="nama_instansi"
                        value="{{ old('nama_instansi', $institute->nama_instansi) }}"
                        class="form-control @error('nama_instansi') is-invalid @enderror" required>
                    @error('nama_instansi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <input id="alamat" type="text" name="alamat" value="{{ old('alamat', $institute->alamat) }}"
                        class="form-control @error('alamat') is-invalid @enderror" required>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
