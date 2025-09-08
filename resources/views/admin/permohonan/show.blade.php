@extends('admin.layoutsadmin.main')

@section('permohonan-active', 'active')
@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 text-gray-800">Detail Permohonan</h1>
    <a href="{{ route('admin.permohonan.index') }}" class="btn btn-secondary">Kembali</a>
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
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6">
          <dl class="row mb-0">
            <dt class="col-5">Instansi</dt>
            <dd class="col-7">{{ $permohonan->instansi }}</dd>

            <dt class="col-5">Tanggal Surat</dt>
            <dd class="col-7">{{ optional($permohonan->tgl_surat)->format('d-m-Y') }}</dd>

            <dt class="col-5">Tanggal Mulai</dt>
            <dd class="col-7">{{ optional($permohonan->tgl_mulai)->format('d-m-Y') }}</dd>

            <dt class="col-5">Tanggal Selesai</dt>
            <dd class="col-7">{{ optional($permohonan->tgl_selesai)->format('d-m-Y') }}</dd>

            <dt class="col-5">Tanggal Surat Masuk</dt>
            <dd class="col-7">{{ optional($permohonan->tgl_suratmasuk)->format('d-m-Y') }}</dd>
          </dl>
        </div>

        <div class="col-md-6">
          <dl class="row mb-0">
            <dt class="col-5">Pembimbing Sekolah</dt>
            <dd class="col-7">{{ $permohonan->pembimbing_sekolah }}</dd>

            <dt class="col-5">Kontak Pembimbing</dt>
            <dd class="col-7">{{ $permohonan->kontak_pembimbing }}</dd>

            <dt class="col-5">Jenis Magang</dt>
            <dd class="col-7">{{ $permohonan->jenis_magang }}</dd>

            <dt class="col-5">Status</dt>
            <dd class="col-7">
              @php
                $cls = match ($permohonan->status) {
                  'Aktif'  => 'bg-success',
                  'Proses' => 'bg-warning text-dark',
                  'Selesai'=> 'bg-primary',
                  default  => 'bg-danger',
                };
              @endphp
              <span class="badge {{ $cls }}">{{ $permohonan->status }}</span>
            </dd>

            <dt class="col-5">File Permohonan</dt>
            <dd class="col-7">
              @if ($permohonan->file_permohonan)
                <a target="_blank" href="{{ Storage::url($permohonan->file_permohonan) }}">Lihat file</a>
              @else
                <em>Tidak ada</em>
              @endif
            </dd>
          </dl>
        </div>
      </div>

      <hr>

      <h5 class="mb-3">Aksi Status</h5>
      <div class="d-flex flex-wrap gap-2">
        @if ($permohonan->status === 'Proses')
          <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}" onsubmit="return confirm('Ubah status menjadi Aktif?');">
            @csrf @method('PATCH')
            <input type="hidden" name="to" value="Aktif">
            <button class="btn btn-success">Set Aktif</button>
          </form>

          <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}" onsubmit="return confirm('Tolak permohonan ini?');">
            @csrf @method('PATCH')
            <input type="hidden" name="to" value="Ditolak">
            <button class="btn btn-danger">Tolak</button>
          </form>
        @endif

        @if ($permohonan->status === 'Aktif')
          <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}" onsubmit="return confirm('Tandai selesai?');">
            @csrf @method('PATCH')
            <input type="hidden" name="to" value="Selesai">
            <button class="btn btn-primary">Tandai Selesai</button>
          </form>

          <form method="POST" action="{{ route('admin.permohonan.status', $permohonan) }}" onsubmit="return confirm('Tolak permohonan ini?');">
            @csrf @method('PATCH')
            <input type="hidden" name="to" value="Ditolak">
            <button class="btn btn-danger">Tolak</button>
          </form>
        @endif

        @if (in_array($permohonan->status, ['Selesai','Ditolak']))
          <span class="text-muted">Tidak ada aksi status tersedia.</span>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
