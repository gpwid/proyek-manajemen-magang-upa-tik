    @extends('admin.layoutsadmin.main')

    @section('title', 'Edit Permohonan')
    @section('permohonan-active', 'active')
    @section('content')
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Edit Permohonan</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="product-card shadow col-12 p-3">
                <form action="{{ route('admin.permohonan.update', $application->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_surat"
                            value="{{ old('tgl_surat', optional($application->tgl_surat)->format('Y-m-d')) }}"
                            class="form-control @error('tgl_surat') is-invalid @enderror">
                        @error('tgl_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Instansi <span class="text-danger">*</span></label>
                        <select name="id_institute" class="form-control @error('id_institute') is-invalid @enderror">
                            <option value="">--Pilih Instansi--</option>
                            @foreach ($searchinstitutes as $x)
                                <option value="{{ $x->id }}"
                                    {{ old('id_institute', $application->id_institute) == $x->id ? 'selected' : '' }}>
                                    {{ $x->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_mulai"
                            value="{{ old('tgl_mulai', optional($application->tgl_mulai)->format('Y-m-d')) }}"
                            class="form-control @error('tgl_mulai') is-invalid @enderror">
                        @error('tgl_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_selesai"
                            value="{{ old('tgl_selesai', optional($application->tgl_selesai)->format('Y-m-d')) }}"
                            class="form-control @error('tgl_selesai') is-invalid @enderror">
                        @error('tgl_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Pembimbing Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="pembimbing_sekolah"
                            value="{{ old('pembimbing_sekolah', $application->pembimbing_sekolah) }}"
                            class="form-control @error('pembimbing_sekolah') is-invalid @enderror">
                        @error('pembimbing_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Kontak Pembimbing <span class="text-danger">*</span></label>
                        <input type="text" name="kontak_pembimbing"
                            value="{{ old('kontak_pembimbing', $application->kontak_pembimbing) }}"
                            class="form-control @error('kontak_pembimbing') is-invalid @enderror">
                        @error('kontak_pembimbing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Jenis Magang <span class="text-danger">*</span></label>
                        <select name="jenis_magang" class="form-control @error('jenis_magang') is-invalid @enderror">
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

                    <div class="mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            @foreach (['Proses', 'Aktif', 'Selesai', 'Ditolak'] as $st)
                                <option value="{{ $st }}"
                                    {{ old('status', $application->status) == $st ? 'selected' : '' }}>
                                    {{ $st }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>File Permohonan (opsional ganti)</label>
                        @if ($application->file_permohonan)
                            <div class="mb-2">
                                <a target="_blank" href="{{ Storage::url($application->file_permohonan) }}">Lihat file saat
                                    ini</a>
                            </div>
                        @endif
                        <input type="file" name="file_permohonan"
                            class="form-control @error('file_permohonan') is-invalid @enderror">
                        @error('file_permohonan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 d-inline float-end">
                        <a class="btn btn-secondary" href="{{ route('admin.permohonan.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
