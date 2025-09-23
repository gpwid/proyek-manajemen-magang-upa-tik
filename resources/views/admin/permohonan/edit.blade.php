{{-- resources/views/admin/permohonan/edit.blade.php --}}
@extends('admin.layoutsadmin.main')

@section('title', 'Edit Permohonan')
@section('permohonan-active', 'active')

@section('content')
    <div class="container-fluid">
        {{-- CSS helper untuk pembatas kolom --}}
        <style>
            /* garis pemisah di kolom kanan bila layout 2 kolom (>= md) */
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

                /* hide di mobile */
            }
        </style>

        {{-- Judul halaman --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800 mb-0">Edit Permohonan</h1>
            {{-- <a href="{{ route('admin.permohonan.index') }}" class="btn btn-outline-secondary">Kembali</a> --}}
        </div>

        {{-- Notifikasi error validasi (global) --}}
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

        {{-- Kartu utama form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- FORM EDIT PERMOHONAN --}}
                <form action="{{ route('admin.permohonan.update', $application->id) }}" method="POST"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- =========================
                     BAGIAN 1: Info Surat
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Info Surat</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- Tanggal Surat --}}
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_surat"
                                    value="{{ old('tgl_surat', optional($application->tgl_surat)->format('Y-m-d')) }}"
                                    class="form-control @error('tgl_surat') is-invalid @enderror" required>
                                @error('tgl_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nomor Surat --}}
                            <div class="col-md-6">
                                <label class="form-label">No. Surat <span class="text-danger">*</span></label>
                                <input type="text" name="no_surat"
                                    value="{{ old('no_surat', $application->no_surat ?? '') }}"
                                    class="form-control @error('no_surat') is-invalid @enderror" maxlength="100" required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 2: Instansi
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Instansi</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- Instansi --}}
                            <div class="col-md-6">
                                <label class="form-label">Instansi <span class="text-danger">*</span></label>
                                <select name="id_institute" class="form-select @error('id_institute') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Instansi --</option>
                                    @foreach ($searchinstitutes as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('id_institute', $application->id_institute) == $x->id ? 'selected' : '' }}>
                                            {{ $x->nama_instansi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_institute')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis Magang --}}
                            <div class="col-md-6">
                                <label class="form-label">Jenis Magang <span class="text-danger">*</span></label>
                                <select name="jenis_magang" class="form-select @error('jenis_magang') is-invalid @enderror"
                                    required>
                                    @foreach (['Mandiri', 'MBKM', 'Sekolah'] as $jm)
                                        <option value="{{ $jm }}"
                                            {{ old('jenis_magang', $application->jenis_magang) == $jm ? 'selected' : '' }}>
                                            {{ $jm }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_magang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 3: Periode Magang
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Periode Magang</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- Tanggal Mulai --}}
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai"
                                    value="{{ old('tgl_mulai', optional($application->tgl_mulai)->format('Y-m-d')) }}"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror" required>
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai"
                                    value="{{ old('tgl_selesai', optional($application->tgl_selesai)->format('Y-m-d')) }}"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror" required>
                                @error('tgl_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 4: Pembimbing
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Pembimbing</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- Pembimbing Sekolah --}}
                            <div class="col-md-6">
                                <label class="form-label">Pembimbing Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="pembimbing_sekolah"
                                    value="{{ old('pembimbing_sekolah', $application->pembimbing_sekolah) }}"
                                    class="form-control @error('pembimbing_sekolah') is-invalid @enderror" maxlength="100"
                                    required>
                                @error('pembimbing_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kontak Pembimbing --}}
                            <div class="col-md-6">
                                <label class="form-label">Kontak Pembimbing <span class="text-danger">*</span></label>
                                <input type="text" name="kontak_pembimbing"
                                    value="{{ old('kontak_pembimbing', $application->kontak_pembimbing) }}"
                                    class="form-control @error('kontak_pembimbing') is-invalid @enderror" maxlength="20"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('kontak_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 5: Status & Catatan
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Status & Catatan</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    @foreach (['Proses', 'Aktif', 'Selesai', 'Ditolak'] as $st)
                                        <option value="{{ $st }}"
                                            {{ old('status', $application->status) == $st ? 'selected' : '' }}>
                                            {{ $st }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Catatan --}}
                            <div class="col-md-6">
                                <label class="form-label">Catatan</label>
                                <input type="text" name="catatan" value="{{ old('catatan', $application->catatan) }}"
                                    class="form-control @error('catatan') is-invalid @enderror" maxlength="255"
                                    placeholder="Opsional">
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 6: Berkas
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Berkas</h6>
                            <span class="ms-2 text-muted small">Unggah ulang hanya bila ingin mengganti</span>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            {{-- File Permohonan --}}
                            <div class="col-md-6">
                                <label class="form-label">File Permohonan</label>
                                @if ($application->file_permohonan)
                                    <div class="mb-2">
                                        <a target="_blank" class="link-primary"
                                            href="{{ Storage::url($application->file_permohonan) }}">
                                            Lihat file saat ini
                                        </a>
                                    </div>
                                @endif
                                <input type="file" name="file_permohonan"
                                    class="form-control @error('file_permohonan') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                @error('file_permohonan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: PDF. Maks 5 MB.</div>
                            </div>

                            {{-- File Surat Balasan --}}
                            <div class="col-md-6">
                                <label class="form-label">File Surat Balasan</label>
                                @if ($application->file_suratbalasan)
                                    <div class="mb-2">
                                        <a target="_blank" class="link-primary"
                                            href="{{ Storage::url($application->file_suratbalasan) }}">
                                            Lihat file saat ini
                                        </a>
                                    </div>
                                @endif
                                <input type="file" name="file_suratbalasan"
                                    class="form-control @error('file_suratbalasan') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                @error('file_suratbalasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER AKSI --}}
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <a class="btn btn-secondary" href="{{ route('admin.permohonan.index') }}">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
