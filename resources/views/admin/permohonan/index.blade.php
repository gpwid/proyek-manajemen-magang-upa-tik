@extends('admin.layoutsadmin.main')
@section('permohonan-active', 'active')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Permohonan Magang</h1>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-success h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-check fa-2x text-success"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalAktif }}</div>
                        <div class="text-muted">Disetujui</div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-warning h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-clock fa-2x text-warning"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalProses }}</div>
                        <div class="text-muted">Proses</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-danger h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalTolak }}</div>
                        <div class="text-muted">Ditolak</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-left-primary h-100 py-2 text-center">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle"><i
                                    class="fas fa-file-invoice fa-2x text-primary"></i>
                            </span>
                        </div>
                        <div class="h4 mb-1 font-weight-bold text-dark">{{ $totalSemua }}</div>
                        <div class="text-muted">Total</div>
                    </div>
                </div>
            </div>

        </div>

        <form method="GET" action="{{ route('admin.permohonan.index') }}">
            <div class="card mb-4">
                <div class="row align-items-end p-3">
                    {{-- Pencarian bebas --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Pencarian</label>
                        <input type="text" name="q" class="form-control"
                            placeholder="Cari nama atau asal instansi…" value="{{ request('q') }}">
                    </div>

                    {{-- Status (single select, samakan dengan enum di DB) --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua status…</option>
                            @foreach (['Proses', 'Aktif', 'Selesai', 'Ditolak'] as $st)
                                <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Instansi (by id_instansi) --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Instansi</label>
                        <select name="instansi" class="form-select">
                            <option value="">-- Pilih Instansi --</option>
                            @forelse ($searchinstansis as $x)
                                <option value="{{ $x->nama_instansi }}" @selected(request('instansi') == $x->nama_instansi)>
                                    {{ $x->nama_instansi }}
                                </option>
                            @empty
                                <option value="">Tidak Ada Instansi</option>
                            @endforelse
                        </select>
                    </div>

                    {{-- Sort tanggal surat --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Surat</label>
                        <select name="sort_date" class="form-select">
                            <option value="desc" @selected(request('sort_date', 'desc') === 'desc')>Terbaru</option>
                            <option value="asc" @selected(request('sort_date') === 'asc')>Terlama</option>
                        </select>
                    </div>

                    {{-- (Opsional) Sort urutan status kustom --}}

                    <div class="col-md-3 mb-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filter</button>
                            <a class="btn btn-secondary" href="{{ route('admin.permohonan.index') }}">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="d-flex justify-start gap-2 mb-4">
            <a href="{{ route('admin.permohonan.tambah') }}"
                class="d-none d-sm-inline-block btn btn-lg btn-primary rounded-3 shadow-sm"><i
                    class="fa-solid fa-file-circle-plus text-white"></i> Permohonan Baru
            </a>
        </div>

        <div class="row">
            @forelse ($permohonan as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 card-hover">
                        <div
                            class="card-header {{ $item->status == 'Aktif' ? 'bg-success-subtle' : ($item->status == 'Proses' ? 'bg-warning-subtle' : ($item->status == 'Selesai' ? 'bg-primary-subtle' : 'bg-danger-subtle')) }}">

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <strong>Permohonan dari : </strong>
                                        <h6 class="mb-0">{{ $item->instansi }}</h6>
                                    </div>
                                </div>
                                <span
                                    class="badge {{ $item->status == 'Aktif' ? 'bg-success' : ($item->status == 'Proses' ? 'bg-warning' : ($item->status == 'Selesai' ? 'bg-primary' : 'bg-danger')) }}">{{ $item->status }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Instansi</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->instansi }}</span>
                                </div>
                                <div class="col-6">
                                    <strong>Jenis Magang</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->jenis_magang }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Pembimbing</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->pembimbing_sekolah }}</span>
                                </div>
                                <div class="col-6">
                                    <strong>Kontak Pembimbing</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->kontak_pembimbing }}</span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Tanggal Mulai</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->tgl_mulai->format('d-m-Y') }}</span>
                                </div>
                                <div class="col-6">
                                    <strong>Tanggal Selesai</strong>
                                    <br>
                                    <span class="text-muted">{{ $item->tgl_selesai->format('d-m-Y') }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="d-flex justify-start gap-2 mb-4">
                                        <a href="{{ route('admin.permohonan.tambah') }}"
                                            class="d-none d-sm-inline-block btn btn-md btn-warning rounded-3 shadow-sm text-black"><i class="fa-solid fa-pen-to-square text-black"></i> Edit Permohonan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100 card-hover">
                        <div class="card-header bg-secondary">
                            Tidak ada permohonan
                        </div>
                    </div>
                </div>
            @endforelse

            <div class="d-flex justify-content-center mt-3">
                {{ $permohonan->links() }}
            </div>

        </div>

    </div>

@endsection
