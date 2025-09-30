@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Pengguna Baru')
@section('users-active', 'active')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tambah Pengguna Baru</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Pengguna Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Peran (Role) <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                                required>
                                <option value="" disabled selected>Pilih peran...</option>
                                <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                                <option value="atasan" @selected(old('role') == 'atasan')>Atasan</option>
                                <option value="pembimbing" @selected(old('role') == 'pembimbing')>Pembimbing</option>
                                <option value="pemagang" @selected(old('role') == 'pemagang')>Pemagang</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Field Kondisional untuk NIP dan NIS/NIM --}}
                    <div class="row">
                        <div class="col-md-6 mb-3" id="nip-field" style="display: none;">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                name="nip" value="{{ old('nip') }}">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3" id="nisnim-field" style="display: none;">
                            <label for="nisnim" class="form-label">NIS/NIM</label>
                            <input type="text" class="form-control @error('nisnim') is-invalid @enderror" id="nisnim"
                                name="nisnim" value="{{ old('nisnim') }}">
                            @error('nisnim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const nipField = document.getElementById('nip-field');
            const nisnimField = document.getElementById('nisnim-field');

            function toggleFields() {
                const selectedRole = roleSelect.value;
                // Tampilkan NIP jika role bukan pemagang dan ada isinya
                nipField.style.display = (selectedRole && selectedRole !== 'pemagang') ? 'block' : 'none';
                // Tampilkan NIS/NIM jika role adalah pemagang
                nisnimField.style.display = (selectedRole === 'pemagang') ? 'block' : 'none';
            }

            roleSelect.addEventListener('change', toggleFields);
            // Panggil saat halaman dimuat untuk menangani old value
            toggleFields();
        });
    </script>
@endpush
