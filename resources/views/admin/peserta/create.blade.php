@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Peserta')
@section('peserta-active', 'active')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Tambah Peserta</h1>
    </div>
    <div class="product-card shadow title-section-content col-12">
        <form action="/peserta" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Nama</label>
                <input value="{{ old('nama') }}" type="text" name="nama" id=""
                    class="form-control @error('nama') is-invalid @enderror">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">NIK</label>
                <input value="{{ old('nik') }}" type="text" name="nik" id=""
                    class="form-control @error('nik') is-invalid @enderror">
                @error('nik')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">NISN/NIM</label>
                <input value="{{ old('nisnim') }}" type="text" name="nisnim" id=""
                    class="form-control @error('nisnim') is-invalid @enderror">
                @error('nisnim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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
            <div class="mb-3">
                <label for="">Jurusan</label>
                <input value="{{ old('jurusan') }}" type="text" name="jurusan" id=""
                    class="form-control @error('jurusan') is-invalid @enderror">
                @error('jurusan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Kontak Peserta</label>
                <input value="{{ old('kontak_peserta') }}" type="text" name="kontak_peserta" id=""
                    class="form-control @error('kontak_peserta') is-invalid @enderror">
                @error('kontak_peserta')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Keterangan</label>
                <input value="{{ old('keterangan') }}" type="text" name="keterangan" id=""
                    class="form-control @error('keterangan') is-invalid @enderror">
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 d-inline float-end">
                <a class="btn btn-secondary" href="/peserta">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

@endsection
