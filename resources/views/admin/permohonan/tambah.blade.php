@extends('admin.layoutsadmin.main')

@section('permohonan-active', 'active')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Permohonan</h1>
        </div>

        {{-- Form Tambah Data --}}
        <div class="product-card shadow title-section-content col-12">
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
                <div class="mb-3">
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
                    <label for="">Instansi <label class="text-danger">*</label></label></label>
                    <select name="id_instansi" class="form-control @error('id_instansi')
            is-invalid @enderror"
                        id="">
                        <option value="">--Pilih Instansi--</option>
                        @forelse ($tempatinstansis as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_instansi }}</option>
                        @empty
                            <option value="">Tidak Ada Instansi</option>
                        @endforelse
                    </select>
                    @error('id_instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
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
                    <label for="">Jenis Magang <label class="text-danger">*</label></label></label>
                    <select name="jenis_magang" id=""
                        class="form-control @error('jenis_magang')
                is-invalid
            @enderror">
                        <option value="">--Jenis Magang--</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="MBKM">MBKM</option>
                        <option value="Sekolah">Sekolah</option>
                    </select>
                    @error('jenis_magang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">File Permohonan <label class="text-danger">*</label></label></label>
                    <input value="{{ old('file_permohonan') }}" type="file" name="file_permohonan" id=""
                        class="form-control @error('file_permohonan') is-invalid @enderror">
                    @error('file_permohonan')
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
