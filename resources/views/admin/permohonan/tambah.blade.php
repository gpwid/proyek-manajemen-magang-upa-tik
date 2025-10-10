{{-- resources/views/admin/permohonan/create.blade.php --}}
@extends('admin.layoutsadmin.main')

@section('title', 'Tambah Permohonan Baru')
@section('permohonan-active', 'active')

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

        {{-- Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Permohonan</h1>
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
                <form action="{{ route('admin.permohonan.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    {{-- =========================
                     BAGIAN 1: Info Surat
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Info Surat</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_surat" value="{{ old('tgl_surat') }}"
                                    class="form-control @error('tgl_surat') is-invalid @enderror" required>
                                @error('tgl_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No. Surat <span class="text-danger">*</span></label>
                                <input type="text" name="no_surat" value="{{ old('no_surat') }}"
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
                            <div class="col-md-6">
                                <label class="form-label">Instansi <span class="text-danger">*</span></label>
                                <select name="id_institute"
                                    class="form-select select2 @error('id_institute') is-invalid @enderror" required>
                                    <option value="">-- Pilih Instansi --</option>
                                    @forelse ($data as $x)
                                        <option value="{{ $x->id }}"
                                            {{ old('id_institute') == $x->id ? 'selected' : '' }}>
                                            {{ $x->nama_instansi }}
                                        </option>
                                    @empty
                                        <option value="">Tidak Ada Instansi</option>
                                    @endforelse
                                </select>
                                @error('id_institute')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Magang <span class="text-danger">*</span></label>
                                <select name="jenis_magang" class="form-select @error('jenis_magang') is-invalid @enderror"
                                    required>
                                    @foreach (['Mandiri', 'MBKM', 'Sekolah'] as $jm)
                                        <option value="{{ $jm }}"
                                            @if (old('jenis_magang') == '{{ $jm }}') selected @endif>{{ $jm }}
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
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror" required>
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
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
                            <div class="col-md-6">
                                <label class="form-label">Pembimbing Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="pembimbing_sekolah" value="{{ old('pembimbing_sekolah') }}"
                                    class="form-control @error('pembimbing_sekolah') is-invalid @enderror" maxlength="100"
                                    required>
                                @error('pembimbing_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kontak Pembimbing <span class="text-danger">*</span></label>
                                <input type="text" name="kontak_pembimbing" value="{{ old('kontak_pembimbing') }}"
                                    class="form-control @error('kontak_pembimbing') is-invalid @enderror" maxlength="20"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('kontak_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                     BAGIAN 5: Catatan (tanpa Status)
                   ========================= --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Catatan</h6>
                        </div>
                        <hr class="mt-2 mb-3">
                        <input type="text" name="catatan" value="{{ old('catatan') }}"
                            class="form-control @error('catatan') is-invalid @enderror" maxlength="255"
                            placeholder="Opsional">
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- =========================
                     BAGIAN 6: Berkas
                   ========================= --}}
                    <div class="mb-2">
                        <div class="d-flex align-items-center">
                            <h6 class="fw-bold mb-0">Berkas</h6>
                            <span class="ms-2 text-muted small">Wajib unggah file permohonan (PDF)</span>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="row g-3 row-split">
                            <div class="col-md-6">
                                <label class="form-label">File Permohonan <span class="text-danger">*</span></label>
                                <input type="file" name="file_permohonan"
                                    class="form-control @error('file_permohonan') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                                @error('file_permohonan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format disarankan: PDF. Maks 5 MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">File Surat Balasan</label>
                                <input type="file" name="file_suratbalasan"
                                    class="form-control @error('file_suratbalasan') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                @error('file_suratbalasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opsional (jika sudah ada).</div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Aksi --}}
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <a class="btn btn-secondary" href="{{ route('admin.permohonan.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-user-plus"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    /* ====== Modernize Select2 (single select) ====== */
    .select2-container .select2-selection--single {
        height: 44px !important;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        /* abu-abu lembut */
        display: flex !important;
        align-items: center !important;
        padding: 0 .75rem !important;
        position: relative !important;
        /* untuk posisikan clear btn */
        box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
    }

    .select2-container--bootstrap4 .select2-selection--single,
    .select2-container--bootstrap-5 .select2-selection--single {
        padding-right: 2.25rem !important;
        /* ruang untuk ikon panah/clear */
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 1.4 !important;
        padding-left: 0 !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: .75rem !important;
    }

    .select2-container .select2-selection--single .select2-selection__clear {
        position: absolute !important;
        right: 2rem !important;
        /* di kiri panah */
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin: 0 !important;
        font-size: 18px !important;
        color: #9ca3af !important;
    }

    .select2-container .select2-selection--single .select2-selection__clear:hover {
        color: #111827 !important;
    }

    /* Fokus: warna & ring halus */
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--bootstrap4.select2-container--focus .select2-selection--single,
    .select2-container--bootstrap-5.select2-container--focus .select2-selection--single {
        border-color: #c7d2fe !important;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2) !important;
        /* indigo ring */
    }

    /* Dropdown: lebih lega & modern */
    .select2-results__option {
        padding: .55rem .75rem !important;
        border-radius: .5rem !important;
        margin: 2px !important;
    }

    .select2-results__option--highlighted {
        background: #eef2ff !important;
        color: #1f2937 !important;
    }

    /* Placeholder agar abu-abu muda */
    .select2-container .select2-selection__placeholder {
        color: #9ca3af !important;
    }

    /* ---- Select2 clear (single select) jadi merah ---- */
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear,
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__clear {
        color: #dc3545 !important;
        /* Bootstrap danger */
        opacity: 1 !important;
        cursor: pointer;
        font-weight: 700;
        /* (opsional) bikin area klik sedikit lebih besar & bundar */
        padding: 2px 6px;
        border-radius: 9999px;
    }

    /* Hover state: lebih tegas */
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear:hover,
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__clear:hover {
        color: #b02a37 !important;
        /* darker danger */
        background: rgba(220, 53, 69, .08);
    }
</style>

@push('scripts')
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Pilih --',
                allowClear: true,
                language: {
                    inputTooShort: () => 'Ketik untuk mencari…',
                    noResults: () => 'Tidak ada data'
                }
            });
        });
    </script>
@endpush
