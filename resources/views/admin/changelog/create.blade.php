@extends('admin.layoutsadmin.main')
@section('title', 'Tambah Changelog')
@section('changelog-active', 'active')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus me-2"></i> Tambah Changelog
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.changelog.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
