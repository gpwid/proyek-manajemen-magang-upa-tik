@extends('admin.layoutsadmin.main')

@section('internship-active', 'active')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800">Detail Data Magang</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.internship.edit', $internship->id) }}" class="btn btn-primary"><i
                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                <a href="{{ route('admin.internship.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Main Information Card -->
            <div class="col-md-12">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fa-solid fa-file-contract me-2"></i> Informasi Magang
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Nama Lengkap -->
                            <div class="col-12">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Asal Pemagang</label>
                                    <div class="info-value" style="font-weight: 700">{{ $internship->permohonan->instansi }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Jenis Magang</label>
                                    <div class="info-value" style="font-weight: 700">{{ $internship->permohonan->jenis_magang }}</div>
                                </div>
                            </div>

                            <!-- NIK & NISN/NIM -->
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Masuk</label>
                                    <div class="info-value" style="font-weight: 700">
                                        {{ $internship->permohonan->tgl_surat->format('d-m-Y') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Tanggal Selesai</label>
                                    <div class="info-value" style="font-weight: 700">
                                        {{ $internship->permohonan->tgl_suratmasuk->format('d-m-Y') }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="info-label text-body-secondary my-0">Status</label>
                                    <div class="info-value" style="font-weight: 700">
                                        @if ($internship->status_magang === 'Aktif')
                                            <span class='badge bg-success'>{{ $internship->status_magang }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $internship->status_magang }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
