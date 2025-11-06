@extends('admin.layoutsadmin.main')
@section('users-active', 'active')
@section('title', 'Detail Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 text-gray-800">Detail Pengguna</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fa-solid fa-user-circle me-2"></i> Informasi Akun Pengguna
                </h5>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Nama Lengkap</label>
                            <div class="info-value fw-bold fs-5">{{ $user->name }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Alamat Email</label>
                            <div class="info-value fw-bold">{{ $user->email }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Peran (Role)</label>
                            <div class="info-value fw-bold">
                                <span class="badge bg-info text-white">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($user->nip)
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">NIP</label>
                                <div class="info-value fw-bold">{{ $user->nip }}</div>
                            </div>
                        </div>
                    @endif

                    @if ($user->nisnim)
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">NIS/NIM</label>
                                <div class="info-value fw-bold">{{ $user->nisnim }}</div>
                            </div>
                        </div>
                    @endif

                    @if ($user->participant->nik)
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label text-body-secondary my-0">NIK</label>
                                <div class="info-value fw-bold">{{ $user->participant->nik }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Akun Dibuat Pada</label>
                            <div class="info-value fw-bold">{{ $user->created_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Terakhir Diperbarui</label>
                            <div class="info-value fw-bold">{{ $user->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label text-body-secondary my-0">Terakhir Login</label>
                            <div class="info-value fw-bold">
                                {{ $user->last_login_at }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Anda bisa menambahkan style kustom di sini jika diperlukan --}}
@push('styles')
    <style>
        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.875rem;
        }

        .info-value {
            font-size: 1rem;
        }
    </style>
@endpush
