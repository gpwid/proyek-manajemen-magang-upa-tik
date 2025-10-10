@extends('admin.layoutsadmin.main')
@section('internship-active', 'active')
@section('title', 'Tambah Data Magang Baru')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-3 text-gray-800">Form Tambah Data Magang</h1>
        </div>

        <div class="card shadow col-12 p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.internship.store') }}" method="POST">
                @csrf

                {{-- Permohonan --}}
                <div class="mb-3">
                    <label class="form-label">Permohonan <span class="text-danger">*</span></label>
                    <select name="id_permohonan" class="form-control select2 @error('id_permohonan') is-invalid @enderror"
                        data-live-search="true">
                        <option value="">-- Pilih Permohonan --</option>
                        @foreach ($permohonan as $pm)
                            <option value="{{ $pm->id }}" {{ old('id_permohonan') == $pm->id ? 'selected' : '' }}>
                                {{ $pm->no_surat }} — {{ $pm->institute->nama_instansi ?? 'Instansi?' }}
                                ({{ $pm->tgl_surat->format('d-m-Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_permohonan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pembimbing --}}
                <div class="mb-3">
                    <label class="form-label">Pembimbing <span class="text-danger">*</span></label>
                    <select name="id_pembimbing" class="form-control select2 @error('id_pembimbing') is-invalid @enderror">
                        <option value="">-- Pilih Pembimbing --</option>
                        @foreach ($supervisors as $sup)
                            <option value="{{ $sup->id }}" {{ old('id_pembimbing') == $sup->id ? 'selected' : '' }}>
                                {{ $sup->nama }} ({{ $sup->nip }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_pembimbing')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Peserta --}}
                <div class="mb-3">
                    <label class="form-label">Peserta <span class="text-danger">*</span></label>
                    <select name="id_peserta[]" class="form-control select2 @error('id_peserta') is-invalid @enderror"
                        multiple required>
                        @foreach ($participants as $peserta)
                            <option value="{{ $peserta->id }}"
                                {{ in_array($peserta->id, old('id_peserta', [])) ? 'selected' : '' }}>
                                {{ $peserta->nama }} ({{ $peserta->nisnim }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end">
                    <a class="btn btn-secondary mr-2" href="{{ route('admin.internship.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
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
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "-- Pilih --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
