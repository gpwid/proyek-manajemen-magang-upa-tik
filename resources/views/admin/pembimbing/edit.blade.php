@extends('admin.layoutsadmin.main')
@section('title', 'Edit Pembimbing')
@section('pembimbing-active', 'active')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Edit Pembimbing</h1>
    </div>
    <div class="card shadow title-section-content col-12 p-4">
        <form action="{{ route('admin.pembimbing.update', $supervisor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                <input id="nama" type="text" name="nama"
                    value="{{ old('nama', $supervisor->nama) }}"
                    class="form-control @error('nama') is-invalid @enderror"
                    required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label fw-semibold">NIP <span class="text-danger">*</span></label>
                <input id="nip" type="text" name="nip"
                    value="{{ old('nip', $supervisor->nip) }}"
                    class="form-control @error('nip') is-invalid @enderror"
                    required>
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.pembimbing.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
