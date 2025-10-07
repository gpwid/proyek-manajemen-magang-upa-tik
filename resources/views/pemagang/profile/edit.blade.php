@extends('pemagang.layoutspemagang.main')
@section('title', 'Profil Saya')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Profil Akun</h1>

        @if (!$user->participant)
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Perhatian!</strong> Anda harus melengkapi data diri di bawah ini untuk dapat menggunakan fitur lain.
            </div>
        @endif

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fa-solid fa-user me-2"></i> Detail Akun
                </h5>
            </div>
            <div class="card-body">
                {{-- Form untuk update informasi profil --}}
                <form method="post" action="{{ route('pemagang.profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ old('name', $user->name) }}" required autofocus>
                        @if ($errors->get('name'))
                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                        @if ($errors->get('email'))
                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    {{-- Bagian Data Diri Peserta --}}
                    <h6 class="font-weight-bold mt-4">Data Diri Peserta</h6>
                    <hr class="mt-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik', $user->participant->nik ?? '') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="" disabled>Pilih...</option>
                                <option value="L" @selected(old('jenis_kelamin', $user->participant->jenis_kelamin ?? '') == 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin', $user->participant->jenis_kelamin ?? '') == 'P')>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jurusan" class="form-label">Jurusan/Program Studi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                name="jurusan" value="{{ old('jurusan', $user->participant->jurusan ?? '') }}" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kontak_peserta" class="form-label">Nomor Telepon/WA <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kontak_peserta') is-invalid @enderror"
                                id="kontak_peserta" name="kontak_peserta"
                                value="{{ old('kontak_peserta', $user->participant->kontak_peserta ?? '') }}" required>
                            @error('kontak_peserta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun_aktif" class="form-label">Tahun Masuk/Angkatan <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun_aktif') is-invalid @enderror"
                                id="tahun_aktif" name="tahun_aktif"
                                value="{{ old('tahun_aktif', $user->participant->tahun_aktif ?? '') }}" required>
                            @error('tahun_aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alamat_asal" class="form-label">Alamat Asal</label>
                            <input type="text" class="form-control" id="alamat_asal" name="alamat_asal"
                                value="{{ old('alamat_asal', $user->participant->alamat_asal ?? '') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                value="{{ old('nama_wali', $user->participant->nama_wali ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kontak_wali" class="form-label">Kontak Wali</label>
                            <input type="text" class="form-control" id="kontak_wali" name="kontak_wali"
                                value="{{ old('kontak_wali', $user->participant->kontak_wali ?? '') }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-success">Tersimpan.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fa-solid fa-key me-2"></i> Ubah Password
                </h5>
            </div>
            <div class="card-body">
                {{-- Form untuk update password --}}
                @include('profile.partials.update-password-form')
            </div>
        </div>

    </div>
@endsection
