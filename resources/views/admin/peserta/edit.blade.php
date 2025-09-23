{{-- resources/views/admin/peserta/edit.blade.php --}}
@extends('admin.layoutsadmin.main')
@section('title', 'Edit Peserta')
@section('peserta-active', 'active')

@section('content')
<div class="container-fluid">
    {{-- CSS helper pembatas kolom --}}
    <style>
      .row-split > .col-md-6 + .col-md-6 { border-left: 1px solid var(--bs-border-color, #dee2e6); }
      .row-split > .col-md-6 { padding-top: .25rem; padding-bottom: .25rem; }
      @media (min-width: 768px) {
        .row-split > .col-md-6:first-child { padding-right: 1rem; }
        .row-split > .col-md-6:last-child  { padding-left: 1rem; }
      }
      @media (max-width: 767.98px) {
        .row-split > .col-md-6 + .col-md-6 { border-left: 0; }
      }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Form Edit Peserta</h1>
    </div>

    <div class="card shadow title-section-content col-12 p-4">
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

        <form action="{{ route('admin.peserta.update', $participant->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            {{-- =========================
                 BAGIAN 1: Identitas
               ========================= --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Identitas</h6>
                <hr class="mt-2 mb-3">
                <div class="row g-3 row-split">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            value="{{ old('nama', $participant->nama) }}"
                            class="form-control @error('nama') is-invalid @enderror"
                            required
                        >
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="col-md-6">
                        <label for="nik" class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                        <input
                            id="nik"
                            type="text" {{-- text agar 0 depan tidak hilang --}}
                            name="nik"
                            value="{{ old('nik', $participant->nik) }}"
                            class="form-control @error('nik') is-invalid @enderror"
                            placeholder="16 digit"
                            maxlength="16"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            required
                        >
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        <label for="nisnim" class="form-label fw-semibold">NISN/NIM <span class="text-danger">*</span></label>
                        <input
                            id="nisnim"
                            type="text"
                            name="nisnim"
                            value="{{ old('nisnim', $participant->nisnim) }}"
                            class="form-control @error('nisnim') is-invalid @enderror"
                            required
                        >
                        @error('nisnim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $participant->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 row-split mt-0">
                    {{-- Jurusan --}}
                    <div class="col-md-6">
                        <label for="jurusan" class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                        <input
                            id="jurusan"
                            type="text"
                            name="jurusan"
                            value="{{ old('jurusan', $participant->jurusan) }}"
                            class="form-control @error('jurusan') is-invalid @enderror"
                            required
                        >
                        @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tahun Aktif --}}
                    <div class="col-md-6">
                        <label for="tahun_aktif" class="form-label fw-semibold">Tahun Aktif <span class="text-danger">*</span></label>
                        <input
                            id="tahun_aktif"
                            type="text" {{-- text agar fleksibel --}}
                            name="tahun_aktif"
                            value="{{ old('tahun_aktif', $participant->tahun_aktif) }}"
                            class="form-control @error('tahun_aktif') is-invalid @enderror"
                            placeholder="Contoh: 2025"
                            maxlength="9"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            required
                        >
                        @error('tahun_aktif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- =========================
                 BAGIAN 3: Kontak
               ========================= --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Kontak</h6>
                <hr class="mt-2 mb-3">
                <div class="row g-3 row-split">
                    {{-- Kontak Peserta --}}
                    <div class="col-md-6">
                        <label for="kontak_peserta" class="form-label fw-semibold">Kontak Peserta <span class="text-danger">*</span></label>
                        <input
                            id="kontak_peserta"
                            type="text"
                            name="kontak_peserta"
                            value="{{ old('kontak_peserta', $participant->kontak_peserta) }}"
                            class="form-control @error('kontak_peserta') is-invalid @enderror"
                            placeholder="Nomor HP/WA (08xxxxxxxxxx)"
                            maxlength="20"
                            required
                        >
                        @error('kontak_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        {{-- Kosong untuk keseimbangan layout, bisa diisi field tambahan nanti --}}
                    </div>
                </div>
            </div>

            {{-- =========================
                 BAGIAN 4: Keterangan (opsional)
               ========================= --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Keterangan</h6>
                <hr class="mt-2 mb-3">
                <input
                    id="keterangan"
                    type="text"
                    name="keterangan"
                    value="{{ old('keterangan', $participant->keterangan) }}"
                    class="form-control @error('keterangan') is-invalid @enderror"
                    placeholder="Tambahkan keterangan (opsional)"
                    maxlength="255"
                >
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end mt-4 gap-2">
                <a class="btn btn-secondary me-2" href="{{ route('admin.peserta.index') }}">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
