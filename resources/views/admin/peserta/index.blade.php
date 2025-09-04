@extends('admin.layoutsadmin.main')
@section('peserta-active', 'active')
@section('title', 'Peserta')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Peserta</h1>
    </div>
    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Peserta Card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Peserta</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peserta Laki-laki Card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Peserta Laki-laki</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['laki_laki'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peserta Perempuan Card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Peserta Perempuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['perempuan'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-primary mb-3" href="{{ route('admin.peserta.create') }}">Tambah Peserta</a>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Filter Jenis Kelamin</label>
                <select id="jenis_kelamin_filter" class="form-control">
                    <option value="">Semua</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pencarian</label>
                <input type="text" id="searchbox" class="form-control" placeholder="Cari...">
            </div>
        </div>
            <table id="participants-table" class="display table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NISN/NIM</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->nisnim }}</td>
                        <td>{{ $p->jenis_kelamin }}</td>
                        <td>{{ $p->jurusan }}</td>
                        <td>{{ $p->kontak_peserta }}</td>
                        <td>
                            <a class="btn badge bg-success" href="/peserta/{{ $p->id }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-clipboard2-data-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
                                    <path
                                        d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1Z" />
                                </svg>
                            </a>
                            <a class="btn badge bg-warning" href="/peserta/{{ $p->id }}/edit" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                            <form onclick="return confirm('Hapus?')" action="/peserta/{{$p->id}}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn badge bg-danger" href="" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data peserta.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if (session('sukses'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session('
        sukses ') }}',
        showConfirmButton: false,
        timer: 1500
    })

</script>
@endif

@endsection

@section('scripts')
@if (session('sukses'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: "{{ session('sukses') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
<script>
    $(function () {
        $('#participants-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("admin.peserta.index") !!}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nisnim',
                    name: 'nisnim'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'jurusan',
                    name: 'jurusan'
                },
                {
                    data: 'kontak_peserta',
                    name: 'kontak_peserta'
                },
            ],
            pageLength: 10,
            responsive: true,
        });
    });

</script>
@endsection
