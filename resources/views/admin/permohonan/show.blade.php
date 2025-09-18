@extends('admin.layoutsadmin.main')

@section('permohonan-active', 'active')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Detail Permohonan</h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.permohonan.edit', $permohonan->id) }}" class="btn btn-primary"><i
                    class="fa-solid fa-pen-to-square"></i> Edit</a>
            <a href="{{ route('admin.permohonan.index') }}" class="btn btn-secondary">Kembali</a>
            @if ($permohonan->status === 'Proses')
            <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}"
                onsubmit="return confirm('Ubah status menjadi Aktif?');">
                @csrf @method('PATCH')
                <input type="hidden" name="to" value="Aktif">
                <button class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Set Aktif</button>
            </form>

            <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}"
                onsubmit="return confirm('Tolak permohonan ini?');">
                @csrf @method('PATCH')
                <input type="hidden" name="to" value="Ditolak">
                <button class="btn btn-danger"><i class="fa-solid fa-circle-xmark"></i> Tolak</button>
            </form>
            @endif

            @if ($permohonan->status === 'Aktif')
            <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}"
                onsubmit="return confirm('Tandai selesai?');">
                @csrf @method('PATCH')
                <input type="hidden" name="to" value="Selesai">
                <button class="btn btn-primary">Tandai Selesai</button>
            </form>

            <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}"
                onsubmit="return confirm('Tolak permohonan ini?');">
                @csrf @method('PATCH')
                <input type="hidden" name="to" value="Ditolak">
                <button class="btn btn-danger">Tolak</button>
            </form>
            @endif

            @if (in_array($permohonan->status, ['Selesai', 'Ditolak']))
            <span class="text-muted">Tidak ada aksi status tersedia.</span>
            @endif
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
                        <i class="fa-solid fa-file-contract me-2"></i> Informasi Permohonan
                    </h5>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Asal Instansi Surat</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->institute->nama_instansi ?? '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">No. Surat</label>
                                <div class="info-value" style="font-weight:700">{{ $permohonan->no_surat }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Jenis Magang</label>
                                <div class="info-value" style="font-weight: 700">{{ $permohonan->jenis_magang }}</div>
                            </div>
                        </div>

                        <!-- NIK & NISN/NIM -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Tanggal Surat dibuat</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->tgl_surat->format('d-m-Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Tanggal Surat Masuk</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->tgl_suratmasuk->format('d-m-Y') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Status</label>
                                <div class="info-value" style="font-weight: 700">
                                    @if ($permohonan->status === 'Aktif')
                                    <span class='badge bg-success'>{{ $permohonan->status }}</span>
                                    @elseif($permohonan->status === 'Proses')
                                    <span class='badge bg-warning text-dark'>{{ $permohonan->status }}</span>
                                    @elseif($permohonan->status === 'Selesai')
                                    <span class='badge bg-primary'>{{ $permohonan->status }}</span>
                                    @elseif($permohonan->status === 'Ditolak')
                                    <span class='badge bg-danger'>{{ $permohonan->status }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Tanggal Mulai Magang</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->tgl_mulai->format('d-m-Y') }}</div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Tanggal Selesai Magang</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->tgl_selesai->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Pembimbing dari Instansi</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->pembimbing_sekolah }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">Kontak Pembimbing</label>
                                <div class="info-value" style="font-weight: 700">
                                    {{ $permohonan->kontak_pembimbing }}
                                </div>
                            </div>
                        </div>

                        {{-- Tambah Peserta --}}
                        <div class="col-12 rounded-top">
                            <a href="{{ route('admin.peserta.create', ['permohonan_id' => $permohonan->id]) }}"
                                class="btn btn-sm btn-primary mb-2">
                                <i class="fa fa-plus"></i> Tambah Peserta
                            </a>

                            <div
                                class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fa-solid fa-users me-2"></i> Peserta pada Surat Permohonan
                                </h5>
                                <span class="badge bg-secondary">Total: {{ $permohonan->participants->count() }}</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:48px;">No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>NISN/NIM</th>
                                                <th>JK</th>
                                                <th>Jurusan</th>
                                                <th>Kontak</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($permohonan->participants as $i => $ps)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td>{{ $ps->nama }}</td>
                                                <td>{{ $ps->nik }}</td>
                                                <td>{{ $ps->nisnim }}</td>
                                                <td>{{ $ps->jenis_kelamin }}</td>
                                                <td>{{ $ps->jurusan }}</td>
                                                <td>{{ $ps->kontak_peserta }}</td>
                                                <td>{{ $ps->keterangan ?? '-' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">Belum ada peserta
                                                    untuk
                                                    permohonan ini.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-12 d-flex bg-primary rounded-top justify-content-between">
                                <div class="align-self-center">
                                    <label class="mt-2 text-white text-lg">File PDF Permohonan</label>
                                </div>
                                <div>
                                    <a download class="btn btn-success me-2 my-2"
                                        href="{{ Storage::url($permohonan->file_permohonan) }}"><i
                                            class="fa-solid fa-file-arrow-down"></i> Unduh file</a>
                                </div>
                            </div>

                            <div class="col-12 ratio ratio-16x9">
                                <iframe src="{{ Storage::url($permohonan->file_permohonan) }}" title="PDF Reader"
                                    style="border:0; width:100%; height:70vh"></iframe>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
