// ===== ADMIN DASHBOARD CONTENT =====

const adminContent = {
    'dashboard': {
        title: 'Dashboard Overview',
        subtitle: 'Selamat datang di Dashboard Administrator',
        content: `
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <h2 class="page-title">Dashboard Overview</h2>
                    <p class="page-subtitle">Ringkasan sistem informasi magang universitas</p>
                </div>

                <!-- Info Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="card info-card card-primary h-100" onclick="loadPage('kelola-data-pemagang')">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-user-graduate fa-2x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">Total Pemagang</div>
                                        <div class="h4 mb-0">47</div>
                                        <div class="small text-success">
                                            <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="card info-card card-warning h-100" onclick="loadPage('kelola-penugasan')">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-tasks fa-2x text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">Total Penugasan</div>
                                        <div class="h4 mb-0">29</div>
                                        <div class="small text-info">
                                            <i class="fas fa-clock"></i> 13 dalam progress
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="card info-card card-success h-100" onclick="loadPage('kelola-penilaian')">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-star fa-2x text-success"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">Rata-rata Nilai</div>
                                        <div class="h4 mb-0">8.7</div>
                                        <div class="small text-success">
                                            <i class="fas fa-arrow-up"></i> Meningkat
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="card info-card card-info h-100" onclick="loadPage('manajemen-pengguna')">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">Total Pengguna</div>
                                        <div class="h4 mb-0">156</div>
                                        <div class="small text-muted">
                                            4 role berbeda
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mb-4">
                    <div class="col-lg-8 mb-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Statistik Pemagang per Bulan</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="pemagangChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Status Penugasan</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="penugasanChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                                <button class="btn btn-sm btn-outline-primary">Lihat Semua</button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Waktu</th>
                                                <th>Aktivitas</th>
                                                <th>User</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>10:30</td>
                                                <td>Permohonan magang baru</td>
                                                <td>Ahmad Fauzi</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>09:15</td>
                                                <td>Tugas diselesaikan</td>
                                                <td>Siti Nurhaliza</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>08:45</td>
                                                <td>Logbook disubmit</td>
                                                <td>Budi Santoso</td>
                                                <td><span class="badge bg-info">Review</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" onclick="loadPage('kelola-data-pemagang')">
                                        <i class="fas fa-plus me-2"></i>Tambah Pemagang
                                    </button>
                                    <button class="btn btn-warning" onclick="loadPage('kelola-penugasan')">
                                        <i class="fas fa-tasks me-2"></i>Buat Penugasan
                                    </button>
                                    <button class="btn btn-success" onclick="loadPage('kelola-penilaian')">
                                        <i class="fas fa-star me-2"></i>Input Penilaian
                                    </button>
                                    <button class="btn btn-info" onclick="loadPage('manajemen-pengguna')">
                                        <i class="fas fa-user-plus me-2"></i>Tambah User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    },

    'kelola-data-pemagang': {
        title: 'Kelola Data Pemagang',
        subtitle: 'Manajemen data mahasiswa dan siswa yang sedang magang',
        content: `
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="page-title">Kelola Data Pemagang</h2>
                    <p class="page-subtitle">Manajemen data mahasiswa dan siswa yang sedang magang</p>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <h4>47</h4>
                                <p class="mb-0">Total Pemagang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-success">
                            <div class="card-body text-center">
                                <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                                <h4>24</h4>
                                <p class="mb-0">Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-user-clock fa-2x text-warning mb-2"></i>
                                <h4>3</h4>
                                <p class="mb-0">Cuti/Izin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-info">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-2x text-info mb-2"></i>
                                <h4>20</h4>
                                <p class="mb-0">Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Actions -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pencarian</label>
                                <input type="text" class="form-control" placeholder="Cari nama, NIM, atau universitas...">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option>Semua Status</option>
                                    <option>Aktif</option>
                                    <option>Cuti/Izin</option>
                                    <option>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Universitas</label>
                                <select class="form-select">
                                    <option>Semua Universitas</option>
                                    <option>Universitas Riau</option>
                                    <option>Universitas Andalas</option>
                                    <option>Politeknik Negeri Padang</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Periode</label>
                                <select class="form-select">
                                    <option>Semua Periode</option>
                                    <option>2025-1</option>
                                    <option>2024-2</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                    <button class="btn btn-success">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Pemagang</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIM/NISN</th>
                                        <th>Universitas/Sekolah</th>
                                        <th>Jurusan</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Ahmad Fauzi Rahman</td>
                                        <td>190810701001</td>
                                        <td>Universitas Riau</td>
                                        <td>Teknik Informatika</td>
                                        <td>2025-1</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Siti Nurhaliza</td>
                                        <td>190810701002</td>
                                        <td>Universitas Riau</td>
                                        <td>Sistem Informasi</td>
                                        <td>2025-1</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Budi Santoso</td>
                                        <td>200810701003</td>
                                        <td>Politeknik Negeri Padang</td>
                                        <td>Teknik Komputer</td>
                                        <td>2025-1</td>
                                        <td><span class="badge bg-warning">Cuti</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        `
    },

    'kelola-penugasan': {
        title: 'Kelola Penugasan',
        subtitle: 'Manajemen tugas dan proyek untuk pemagang',
        content: `
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="page-title">Kelola Penugasan</h2>
                    <p class="page-subtitle">Manajemen tugas dan proyek untuk pemagang</p>
                </div>

                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-tasks fa-2x text-primary mb-2"></i>
                                <h4>29</h4>
                                <p class="mb-0">Total Tugas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h4>13</h4>
                                <p class="mb-0">Dalam Progress</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-success">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <h4>15</h4>
                                <p class="mb-0">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                                <h4>2</h4>
                                <p class="mb-0">Terlambat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pencarian</label>
                                <input type="text" class="form-control" placeholder="Cari judul tugas...">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option>Semua Status</option>
                                    <option>To Do</option>
                                    <option>In Progress</option>
                                    <option>Review</option>
                                    <option>Done</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Prioritas</label>
                                <select class="form-select">
                                    <option>Semua Prioritas</option>
                                    <option>Tinggi</option>
                                    <option>Sedang</option>
                                    <option>Rendah</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Assignee</label>
                                <select class="form-select">
                                    <option>Semua Pemagang</option>
                                    <option>Ahmad Fauzi</option>
                                    <option>Siti Nurhaliza</option>
                                    <option>Budi Santoso</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-plus"></i> Buat Tugas
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kanban Board -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Kanban Board - Manajemen Tugas</h5>
                    </div>
                    <div class="card-body">
                        <div class="kanban-board">
                            <!-- To Do Column -->
                            <div class="kanban-column">
                                <div class="kanban-header">
                                    <span class="kanban-title">To Do</span>
                                    <span class="kanban-count">4</span>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-danger">Tinggi</span>
                                        <small class="text-muted">25 Agt</small>
                                    </div>
                                    <h6>Analisis Sistem Database</h6>
                                    <p class="small text-muted">Melakukan analisis struktur database dan optimasi query...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Ahmad Fauzi">
                                        <small class="text-muted">30 Agt</small>
                                    </div>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-warning">Sedang</span>
                                        <small class="text-muted">27 Agt</small>
                                    </div>
                                    <h6>Dokumentasi API</h6>
                                    <p class="small text-muted">Membuat dokumentasi lengkap untuk REST API...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Siti Nurhaliza">
                                        <small class="text-muted">2 Sep</small>
                                    </div>
                                </div>
                            </div>

                            <!-- In Progress Column -->
                            <div class="kanban-column">
                                <div class="kanban-header">
                                    <span class="kanban-title">In Progress</span>
                                    <span class="kanban-count">3</span>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-danger">Tinggi</span>
                                        <small class="text-muted">20 Agt</small>
                                    </div>
                                    <h6>Pengembangan Modul Laporan</h6>
                                    <p class="small text-muted">Membuat modul laporan dengan fitur export PDF dan Excel...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Budi Santoso">
                                        <small class="text-muted">28 Agt</small>
                                    </div>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-warning">Sedang</span>
                                        <small class="text-muted">22 Agt</small>
                                    </div>
                                    <h6>Testing Sistem</h6>
                                    <p class="small text-muted">Melakukan pengujian fungsional dan performa sistem...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Ahmad Fauzi">
                                        <small class="text-muted">30 Agt</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Column -->
                            <div class="kanban-column">
                                <div class="kanban-header">
                                    <span class="kanban-title">Review</span>
                                    <span class="kanban-count">2</span>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success">Rendah</span>
                                        <small class="text-muted">18 Agt</small>
                                    </div>
                                    <h6>UI/UX Improvement</h6>
                                    <p class="small text-muted">Perbaikan antarmuka pengguna berdasarkan feedback user...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Siti Nurhaliza">
                                        <small class="text-muted">25 Agt</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Done Column -->
                            <div class="kanban-column">
                                <div class="kanban-header">
                                    <span class="kanban-title">Done</span>
                                    <span class="kanban-count">5</span>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success">Selesai</span>
                                        <small class="text-muted">15 Agt</small>
                                    </div>
                                    <h6>Setup Development Environment</h6>
                                    <p class="small text-muted">Konfigurasi lingkungan pengembangan dan tools yang diperlukan...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Ahmad Fauzi">
                                        <small class="text-muted">20 Agt</small>
                                    </div>
                                </div>
                                <div class="kanban-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success">Selesai</span>
                                        <small class="text-muted">10 Agt</small>
                                    </div>
                                    <h6>Database Design</h6>
                                    <p class="small text-muted">Perancangan struktur database dan relasi antar tabel...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="images/avatar-admin.jpg" class="rounded-circle" width="24" height="24" title="Budi Santoso">
                                        <small class="text-muted">15 Agt</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    },

    'kelola-penilaian': {
        title: 'Kelola Penilaian',
        subtitle: 'Manajemen penilaian dan evaluasi pemagang',
        content: `
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="page-title">Kelola Penilaian</h2>
                    <p class="page-subtitle">Manajemen penilaian dan evaluasi pemagang</p>
                </div>

                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-star fa-2x text-primary mb-2"></i>
                                <h4>8.7</h4>
                                <p class="mb-0">Rata-rata Nilai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-success">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <h4>24</h4>
                                <p class="mb-0">Sudah Dinilai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h4>7</h4>
                                <p class="mb-0">Menunggu Penilaian</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-info">
                            <div class="card-body text-center">
                                <i class="fas fa-trophy fa-2x text-info mb-2"></i>
                                <h4>5</h4>
                                <p class="mb-0">Nilai A</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pencarian</label>
                                <input type="text" class="form-control" placeholder="Cari nama pemagang...">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status Penilaian</label>
                                <select class="form-select">
                                    <option>Semua Status</option>
                                    <option>Sudah Dinilai</option>
                                    <option>Belum Dinilai</option>
                                    <option>Draft</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Periode</label>
                                <select class="form-select">
                                    <option>Semua Periode</option>
                                    <option>2025-1</option>
                                    <option>2024-2</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Pembimbing</label>
                                <select class="form-select">
                                    <option>Semua Pembimbing</option>
                                    <option>Dr. Siti Nurhaliza</option>
                                    <option>Prof. Ahmad Rahman</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-plus"></i> Input Penilaian
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-file-excel"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Penilaian Pemagang</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemagang</th>
                                        <th>Universitas</th>
                                        <th>Pembimbing</th>
                                        <th>Periode</th>
                                        <th>Nilai Akhir</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="images/avatar-admin.jpg" class="rounded-circle me-2" width="32" height="32">
                                                Ahmad Fauzi Rahman
                                            </div>
                                        </td>
                                        <td>Universitas Riau</td>
                                        <td>Dr. Siti Nurhaliza</td>
                                        <td>2025-1</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-2" style="width: 60px; height: 8px;">
                                                    <div class="progress-bar bg-success" style="width: 87%"></div>
                                                </div>
                                                <span class="fw-bold">8.7</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">A</span></td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Print">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="images/avatar-admin.jpg" class="rounded-circle me-2" width="32" height="32">
                                                Siti Nurhaliza
                                            </div>
                                        </td>
                                        <td>Universitas Riau</td>
                                        <td>Prof. Ahmad Rahman</td>
                                        <td>2025-1</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-2" style="width: 60px; height: 8px;">
                                                    <div class="progress-bar bg-primary" style="width: 82%"></div>
                                                </div>
                                                <span class="fw-bold">8.2</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">B+</span></td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Print">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="images/avatar-admin.jpg" class="rounded-circle me-2" width="32" height="32">
                                                Budi Santoso
                                            </div>
                                        </td>
                                        <td>Politeknik Negeri Padang</td>
                                        <td>Dr. Siti Nurhaliza</td>
                                        <td>2025-1</td>
                                        <td>
                                            <span class="text-muted">-</span>
                                        </td>
                                        <td><span class="badge bg-secondary">-</span></td>
                                        <td><span class="badge bg-warning">Belum Dinilai</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" title="Input Penilaian">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" title="Draft">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Komponen Penilaian -->
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Komponen Penilaian</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Kehadiran (20%)</span>
                                        <span class="fw-bold">8.5</span>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Kinerja Tugas (30%)</span>
                                        <span class="fw-bold">8.8</span>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-primary" style="width: 88%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Sikap & Perilaku (25%)</span>
                                        <span class="fw-bold">9.0</span>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-success" style="width: 90%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Laporan Akhir (25%)</span>
                                        <span class="fw-bold">8.5</span>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-info" style="width: 85%"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Nilai Akhir</span>
                                    <span class="fw-bold text-success">8.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Distribusi Nilai</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="nilaiChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    },

    'manajemen-pengguna': {
        title: 'Manajemen Pengguna',
        subtitle: 'Kelola akun pengguna dan hak akses sistem',
        content: `
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="page-title">Manajemen Pengguna</h2>
                    <p class="page-subtitle">Kelola akun pengguna dan hak akses sistem</p>
                </div>

                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <h4>156</h4>
                                <p class="mb-0">Total Pengguna</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-success">
                            <div class="card-body text-center">
                                <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                                <h4>142</h4>
                                <p class="mb-0">Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-user-clock fa-2x text-warning mb-2"></i>
                                <h4>14</h4>
                                <p class="mb-0">Tidak Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card info-card card-info">
                            <div class="card-body text-center">
                                <i class="fas fa-user-shield fa-2x text-info mb-2"></i>
                                <h4>4</h4>
                                <p class="mb-0">Role Berbeda</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Distribution -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-user-shield fa-2x text-danger mb-2"></i>
                                <h5>3</h5>
                                <p class="mb-0">Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-user-tie fa-2x text-warning mb-2"></i>
                                <h5>12</h5>
                                <p class="mb-0">Atasan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-user-graduate fa-2x text-success mb-2"></i>
                                <h5>125</h5>
                                <p class="mb-0">Pemagang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-chalkboard-teacher fa-2x text-info mb-2"></i>
                                <h5>16</h5>
                                <p class="mb-0">Pembimbing</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pencarian</label>
                                <input type="text" class="form-control" placeholder="Cari nama atau username...">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select">
                                    <option>Semua Role</option>
                                    <option>Admin</option>
                                    <option>Atasan</option>
                                    <option>Pemagang</option>
                                    <option>Pembimbing</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option>Semua Status</option>
                                    <option>Aktif</option>
                                    <option>Tidak Aktif</option>
                                    <option>Suspended</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Divisi</label>
                                <select class="form-select">
                                    <option>Semua Divisi</option>
                                    <option>IT</option>
                                    <option>HR</option>
                                    <option>Finance</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-plus"></i> Tambah User
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-file-excel"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Daftar Pengguna</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i> Bulk Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Bulk Delete
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input">
                                        </th>
                                        <th>Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Divisi</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Administrator Sistem</td>
                                        <td>admin</td>
                                        <td>admin@unri.ac.id</td>
                                        <td><span class="badge bg-danger">Admin</span></td>
                                        <td>IT</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>25 Agt 2025, 10:30</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Reset Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Supervisor Divisi</td>
                                        <td>atasan</td>
                                        <td>supervisor@unri.ac.id</td>
                                        <td><span class="badge bg-warning">Atasan</span></td>
                                        <td>IT</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>25 Agt 2025, 09:15</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Reset Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Ahmad Fauzi Rahman</td>
                                        <td>pemagang</td>
                                        <td>ahmad.fauzi@student.unri.ac.id</td>
                                        <td><span class="badge bg-success">Pemagang</span></td>
                                        <td>IT</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>25 Agt 2025, 08:45</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Reset Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td><img src="images/avatar-admin.jpg" class="rounded-circle" width="40" height="40"></td>
                                        <td>Dr. Siti Nurhaliza</td>
                                        <td>pembimbing</td>
                                        <td>siti.nurhaliza@unri.ac.id</td>
                                        <td><span class="badge bg-info">Pembimbing</span></td>
                                        <td>IT</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>24 Agt 2025, 16:20</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Reset Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        `
    }
};

// Function to get content by page
function getAdminContent(page) {
    return adminContent[page] || adminContent['dashboard'];
}

