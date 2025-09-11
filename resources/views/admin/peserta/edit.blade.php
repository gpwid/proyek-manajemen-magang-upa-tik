@extends('admin.layoutsadmin.main')
@section('title', 'Edit Peserta')
@section('peserta-active', 'active')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Edit Peserta</h1>
    </div>
    <div class="card shadow title-section-content col-12 p-4">
        <form action="{{ route('admin.peserta.update', $participant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                <input id="nama" type="text" name="nama"
                    value="{{ old('nama', $participant->nama) }}"
                    class="form-control @error('nama') is-invalid @enderror"
                    required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                <input id="nik" type="text" name="nik"
                    value="{{ old('nik', $participant->nik) }}"
                    class="form-control @error('nik') is-invalid @enderror"
                    required>
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nisnim" class="form-label fw-semibold">NISN/NIM <span class="text-danger">*</span></label>
                <input id="nisnim" type="text" name="nisnim"
                    value="{{ old('nisnim', $participant->nisnim) }}"
                    class="form-control @error('nisnim') is-invalid @enderror"
                    required>
                @error('nisnim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                    required>
                    <option value="">--Jenis Kelamin--</option>
                    <option value="L" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jurusan" class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                <input id="jurusan" type="text" name="jurusan"
                    value="{{ old('jurusan', $participant->jurusan) }}"
                    class="form-control @error('jurusan') is-invalid @enderror"
                    required>
                @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kontak_peserta" class="form-label fw-semibold">Kontak Peserta <span class="text-danger">*</span></label>
                <input id="kontak_peserta" type="text" name="kontak_peserta"
                    value="{{ old('kontak_peserta', $participant->kontak_peserta) }}"
                    class="form-control @error('kontak_peserta') is-invalid @enderror"
                    required>
                @error('kontak_peserta')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <input id="keterangan" type="text" name="keterangan"
                    value="{{ old('keterangan', $participant->keterangan) }}"
                    class="form-control @error('keterangan') is-invalid @enderror">
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a class="btn btn-secondary me-2" href="{{ route('admin.peserta.index') }}">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
