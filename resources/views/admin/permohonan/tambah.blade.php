@extends('admin.layoutsadmin.main')

@section('title', 'Tambah Permohonan Baru')
@section('permohonan-active', 'active')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Permohonan</h1>
        </div>

        {{-- Form Tambah Data --}}
        <div class="card shadow title-section-content col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.permohonan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-2">
                    <label for="">Tanggal Surat <label class="text-danger">*</label></label>
                    <input value="{{ old('tgl_surat') }}" type="date" name="tgl_surat" id=""
                        class="form-control @error('tgl_surat') is-invalid @enderror">
                    @error('tgl_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_institute">Instansi <span class="text-danger">*</span></label>
                    <select name="id_institute" class="form-control @error('id_institute') is-invalid @enderror"
                        id="id_institute">
                        <option value="">--Pilih Instansi--</option>
                        @forelse ($data as $x)
                            <option value="{{ $x->id }}" @if (old('id_institute') == $x->id) selected @endif>
                                {{ $x->nama_instansi }}</option>
                        @empty
                            <option value="">Tidak Ada Instansi</option>
                        @endforelse
                    </select>
                    @error('id_institute')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>No. Surat <span class="text-danger">*</span></label>
                    <input type="text" name="no_surat" value="{{ old('no_surat', $application->no_surat ?? '') }}"
                        class="form-control @error('no_surat') is-invalid @enderror">
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Tanggal Mulai <label class="text-danger">*</label></label></label>
                    <input value="{{ old('tgl_mulai') }}" type="date" name="tgl_mulai" id=""
                        class="form-control @error('tgl_mulai') is-invalid @enderror">
                    @error('tgl_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Tanggal Selesai <label class="text-danger">*</label></label></label>
                    <input value="{{ old('tgl_selesai') }}" type="date" name="tgl_selesai" id=""
                        class="form-control @error('tgl_selesai') is-invalid @enderror">
                    @error('tgl_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Pembimbing Sekolah <label class="text-danger">*</label></label></label>
                    <input value="{{ old('pembimbing_sekolah') }}" type="teks" name="pembimbing_sekolah" id=""
                        class="form-control @error('pembimbing_sekolah') is-invalid @enderror">
                    @error('pembimbing_sekolah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Kontak Pembimbing <label class="text-danger">*</label></label></label>
                    <input value="{{ old('kontak_pembimbing') }}" type="number" name="kontak_pembimbing" id=""
                        class="form-control @error('kontak_pembimbing') is-invalid @enderror">
                    @error('kontak_pembimbing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_magang">Jenis Magang <span class="text-danger">*</span></label>
                    <select name="jenis_magang" id="jenis_magang"
                        class="form-control @error('jenis_magang') is-invalid @enderror">
                        <option value="">--Jenis Magang--</option>
                        <option value="Mandiri" @if (old('jenis_magang') == 'Mandiri') selected @endif>Mandiri</option>
                        <option value="MBKM" @if (old('jenis_magang') == 'MBKM') selected @endif>MBKM</option>
                        <option value="Sekolah" @if (old('jenis_magang') == 'Sekolah') selected @endif>Sekolah</option>
                    </select>
                    @error('jenis_magang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file_permohonan">File Permohonan <span class="text-danger">*</span></label>
                    <input type="file" name="file_permohonan" id="file_permohonan"
                        class="form-control @error('file_permohonan') is-invalid @enderror">
                    @error('file_permohonan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input value="{{ old('file_suratbalasan') }}" type="hidden" name="file_suratbalasan" id=""
                        class="form-control @error('file_suratbalasan') is-invalid @enderror">
                    @error('file_suratbalasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input value="{{ old('catatan') }}" type="hidden" name="catatan" id=""
                        class="form-control @error('catatan') is-invalid @enderror">
                    @error('catatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 d-inline float-end">
                    <a class="btn btn-secondary" href="{{ route('admin.permohonan.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Tambah</button>
                </div>
            </form>
        </div>

    </div>

@endsection
