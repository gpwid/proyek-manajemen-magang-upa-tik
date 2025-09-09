@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Peserta')
@section('peserta-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Tambah Peserta</h1>
    </div>

    <div class="card shadow col-12 p-4">
        <form action="/peserta" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama <span class="text-danger">*</span></label>
                <input value="{{ old('nama') }}" type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- NIK --}}
            <div class="mb-3">
                <label class="form-label">NIK <span class="text-danger">*</span></label>
                <input value="{{ old('nik') }}" type="text" name="nik"
                       class="form-control @error('nik') is-invalid @enderror"
                       placeholder="Masukkan NIK">
                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- NISN/NIM --}}
            <div class="mb-3">
                <label class="form-label">NISN/NIM <span class="text-danger">*</span></label>
                <input value="{{ old('nisnim') }}" type="text" name="nisnim"
                       class="form-control @error('nisnim') is-invalid @enderror"
                       placeholder="Masukkan NISN/NIM">
                @error('nisnim') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin')
                is-invalid
            @enderror">
                    <option value="">--Jenis Kelamin--</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jurusan --}}
            <div class="mb-3">
                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                <input value="{{ old('jurusan') }}" type="text" name="jurusan"
                       class="form-control @error('jurusan') is-invalid @enderror"
                       placeholder="Masukkan jurusan">
                @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Kontak --}}
            <div class="mb-3">
                <label class="form-label">Kontak Peserta <span class="text-danger">*</span></label>
                <input value="{{ old('kontak_peserta') }}" type="text" name="kontak_peserta"
                       class="form-control @error('kontak_peserta') is-invalid @enderror"
                       placeholder="Masukkan nomor HP/WA">
                @error('kontak_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Keterangan (opsional) --}}
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input value="{{ old('keterangan') }}" type="text" name="keterangan"
                       class="form-control @error('keterangan') is-invalid @enderror"
                       placeholder="Tambahkan keterangan (opsional)">
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary mr-2" href="/peserta">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
