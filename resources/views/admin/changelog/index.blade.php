@extends('admin.layoutsadmin.main')
@section('title', 'Changelog')
@section('changelog-active', 'active')
@section('content')

    <div class="container-fluid">

        <div class="row g-3">
            <div class="col-12">
                <div class="card shadow-sm border-0 mb-2">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i> Changelog v1.05
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <label class="info-label">Changelog</label>
                                    <div class="info-value">
                                        <ul>
                                            <li>Memperbaiki sistem password awal registrasi dari angka NIS/NIM ke NIK untuk
                                                peserta magang yang tidak sedang menempuh pendidikan</li>
                                            <li>Menambahkan menu untuk melihat changelog.</li>
                                            <li>Menambahkan kolom tabel baru di menu Pengguna untuk melihat waktu login
                                                terakhir.</li>
                                        </ul>
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
