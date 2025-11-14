{{-- resources/views/admin/peserta/create.blade.php --}}
@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Peserta')
@section('peserta-active', 'active')

@section('content')
    <div class="container-fluid">
        {{-- CSS helper pembatas kolom --}}
        <style>
            .row-split>.col-md-6+.col-md-6 {
                border-left: 1px solid var(--bs-border-color, #dee2e6);
            }

            .row-split>.col-md-6 {
                padding-top: .25rem;
                padding-bottom: .25rem;
            }

            @media (min-width: 768px) {
                .row-split>.col-md-6:first-child {
                    padding-right: 1rem;
                }

                .row-split>.col-md-6:last-child {
                    padding-left: 1rem;
                }
            }

            @media (max-width: 767.98px) {
                .row-split>.col-md-6+.col-md-6 {
                    border-left: 0;
                }
            }
        </style>

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Form Tambah Peserta</h1>
        </div>

        <div class="card shadow col-12 p-4">
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

            <form action="{{ route('admin.peserta.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Hidden input permohonan --}}
                <input type="hidden" name="permohonan_id" value="{{ old('permohonan_id', request('permohonan_id')) }}">

                {{-- =========================
                 BAGIAN 1: Identitas
               ========================= --}}
                <div class="mb-3">
                    <h6 class="fw-bold mb-0">Identitas</h6>
                    <hr class="mt-2 mb-3">
                    <div class="row g-3 row-split">
                        {{-- Nama --}}
                        <div class="col-md-6">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap"
                                required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="col-md-6">
                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" {{-- pakai text agar 0 depan tidak hilang --}} name="nik" value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror"
                                placeholder="Masukkan NIK (16 digit)" maxlength="16" inputmode="numeric" pattern="[0-9]*"
                                required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- =========================
                 BAGIAN 2: Data Akademik
               ========================= --}}
                <div class="mb-3">
                    <h6 class="fw-bold mb-0">Data Akademik</h6>
                    <hr class="mt-2 mb-3">
                    <div class="row g-3 row-split">
                        {{-- NISN/NIM --}}
                        <div class="col-md-6">
                            <label class="form-label">NISN/NIM </label>
                            <input type="text" name="nisnim" value="{{ old('nisnim') }}"
                                class="form-control @error('nisnim') is-invalid @enderror" placeholder="Masukkan NISN/NIM">
                            @error('nisnim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                required>
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 row-split mt-0">

                        <div class="col-md-6">
                            <label for="institute_id" class="form-label fw-semibold">Instansi Asal </label>
                            <select id="institute_id" name="institute_id"
                                class="form-select @error('institute_id') is-invalid @enderror">
                                <option value="">-- Pilih Instansi --</option>
                                @foreach ($institutes as $institute)
                                    <option value="{{ $institute->id }}"
                                        {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                                        {{ $institute->nama_instansi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('institute_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- Tahun Aktif --}}
                        <div class="col-md-6">
                            <label class="form-label">Tahun Aktif <span class="text-danger">*</span></label>
                            <input type="text" {{-- text agar fleksibel (angkatan 2023/2024, dsb) --}} name="tahun_aktif"
                                value="{{ old('tahun_aktif') }}"
                                class="form-control @error('tahun_aktif') is-invalid @enderror" placeholder="Contoh: 2025"
                                maxlength="9" inputmode="numeric" pattern="[0-9]*" required>
                            @error('tahun_aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                {{-- =========================
                 BAGIAN 4: Keterangan (opsional)
               ========================= --}}
                <div class="mb-3">
                    <h6 class="fw-bold mb-0">Keterangan</h6>
                    <hr class="mt-2 mb-3">
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Tambahkan keterangan (opsional)" maxlength="255">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2 pt-2">
                    <a class="btn btn-secondary"
                        href="{{ old('permohonan_id', request('permohonan_id')) ? route('admin.permohonan.show', old('permohonan_id', request('permohonan_id'))) : route('admin.peserta.index') }}">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
