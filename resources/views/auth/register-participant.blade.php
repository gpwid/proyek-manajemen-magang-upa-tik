<x-guest-layout>
    <div class="container-fluid">

        {{-- Heading --}}
        <div class="row justify-content-center align-items-center mb-3">
            <h3 class="text-center mb-2">Formulir Pendaftaran Peserta Magang</h3>
            <p class="text-center text-muted mb-4">Isi data diri Anda untuk mengajukan permohonan magang.</p>
        </div>

        {{-- Notifikasi error global --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <div class="fw-semibold mb-2">Periksa kembali input berikut:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Kartu Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('participant.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf


                    <hr class="mt-2 mb-3">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">NIS/NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nisnim" value="{{ old('nisnim') }}"
                                class="form-control @error('nisnim') is-invalid @enderror" maxlength="100" required>
                            @error('nisnim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nomor Induk Kependudukan (NIK) <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror" maxlength="100" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <hr class="mt-2 mb-3">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Asal Instansi <span class="text-danger">*</span></label>
                            <select name="institute_id" class="form-select @error('institute_id') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Instansi --</option>
                                @forelse ($institutes as $x)
                                    <option value="{{ $x->id }}"
                                        {{ old('institute_id') == $x->id ? 'selected' : '' }}>
                                        {{ $x->nama_instansi }}
                                    </option>
                                @empty
                                    <option value="">Tidak Ada Instansi</option>
                                @endforelse
                            </select>
                            @error('institute_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                                class="form-control @error('jurusan') is-invalid @enderror" maxlength="100" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Kontak Peserta <span class="text-danger">*</span></label>
                            <input type="text" name="kontak_peserta" value="{{ old('kontak_peserta') }}"
                                class="form-control @error('kontak_peserta') is-invalid @enderror" maxlength="100"
                                required>
                            @error('kontak_peserta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Email Peserta <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" maxlength="100" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label"></label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat_asal" rows="3" class="form-control @error('alamat_asal') is-invalid @enderror" required>{{ old('alamat_asal') }}</textarea>
                            @error('alamat_asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                                class="form-control @error('nama_wali') is-invalid @enderror" maxlength="100"
                                required>
                            @error('nama_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Kontak Wali</label>
                            <input type="text" name="kontak_wali" value="{{ old('kontak_wali') }}"
                                class="form-control @error('kontak_wali') is-invalid @enderror" maxlength="100"
                                required>
                            @error('kontak_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Footer Aksi --}}
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-user-plus"></i> Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
