@extends('admin.layoutsadmin.main')
@section('title', 'Edit Peserta')
@section('peserta-active', 'active')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Edit Peserta</h1>
    </div>
    <div class="product-card shadow title-section-content col-12">
        <form action="{{ route('admin.peserta.update', $participant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="">Nama</label>
                <input value="{{ old('nama', $participant->nama) }}" type="text" name="nama"
                    class="form-control @error('nama') is-invalid @enderror">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">NIK</label>
                <input value="{{ old('nik', $participant->nik) }}" type="text" name="nik"
                    class="form-control @error('nik') is-invalid @enderror">
                @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">NISN/NIM</label>
                <input value="{{ old('nisnim', $participant->nisnim) }}" type="text" name="nisnim"
                    class="form-control @error('nisnim') is-invalid @enderror">
                @error('nisnim')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">--Jenis Kelamin--</option>
                    <option value="L" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">Jurusan</label>
                <input value="{{ old('jurusan', $participant->jurusan) }}" type="text" name="jurusan"
                    class="form-control @error('jurusan') is-invalid @enderror">
                @error('jurusan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">Kontak Peserta</label>
                <input value="{{ old('kontak_peserta', $participant->kontak_peserta) }}" type="text" name="kontak_peserta"
                    class="form-control @error('kontak_peserta') is-invalid @enderror">
                @error('kontak_peserta')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">Keterangan</label>
                <input value="{{ old('keterangan', $participant->keterangan) }}" type="text" name="keterangan"
                    class="form-control @error('keterangan') is-invalid @enderror">
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 d-inline float-end">
                <a class="btn btn-secondary" href="{{ route('admin.peserta.index') }}">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
