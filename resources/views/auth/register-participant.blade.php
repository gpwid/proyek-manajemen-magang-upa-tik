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
                            <select name="institute_id"
                                class="form-select select2-filter @error('institute_id') is-invalid @enderror" required>
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
        // Inisialisasi Select2 untuk elemen dengan kelas 'select2-filter'
        $(document).ready(function() {
            $('.select2-filter').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Instansi --',
                allowClear: true,
            });
        });
    </script>
