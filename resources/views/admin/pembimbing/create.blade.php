@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Pembimbing')
@section('pembimbing-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Tambah Pembimbing</h1>
    </div>

    <div class="card shadow col-12 p-4">
        <form action="{{ route('admin.pembimbing.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama <span class="text-danger">*</span></label>
                <input value="{{ old('nama') }}" type="text" name="nama"
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap" required>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- NIP --}}
            <div class="mb-3">
                <label class="form-label">NIP <span class="text-danger">*</span></label>
                <input value="{{ old('nip') }}" type="text" name="nip"
                    class="form-control @error('nip') is-invalid @enderror" placeholder="Masukkan NIP" required>
                @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Email (manual, unique) --}}
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input value="{{ old('email') }}" type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="nama@domain.ac.id" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-text">Email ini juga digunakan sebagai email akun login pembimbing.</div>
            </div>

            <div class="alert alert-info">
                Password awal akun = <strong>NIP</strong>. Mohon ganti setelah login pertama.
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary mr-2" href="{{ route('admin.pembimbing.index') }}">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
