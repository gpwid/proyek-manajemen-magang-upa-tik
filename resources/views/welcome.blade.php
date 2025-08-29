<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Informasi Magang</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">">
</head>
<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <!-- Logo dan Nama Aplikasi -->
            <div class="navbar-brand d-flex align-items-center">
                <img src="images/logo-univ.png" alt="Logo Universitas" class="logo-img me-2" width="40" height="40">
                <span class="app-title">Sistem Informasi Magang</span>
            </div>

            <!-- Sidebar Toggle Button -->
            <button class="btn btn-outline-light d-lg-none" type="button" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Right -->
            <div class="navbar-nav ms-auto d-flex flex-row">
                <!-- Notifikasi -->
                <div class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            5
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                        <li><h6 class="dropdown-header">Notifikasi Terbaru</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-plus text-primary me-2"></i>Permohonan magang baru dari Ahmad</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-clock text-warning me-2"></i>Deadline tugas minggu ini</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar text-info me-2"></i>Absensi belum diisi hari ini</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">Lihat Semua Notifikasi</a></li>
                    </ul>
                </div>

                <!-- Profil Pengguna -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="images/avatar-admin.jpg" alt="Admin Avatar" class="rounded-circle me-2" width="32" height="32">
                        <span class="d-none d-md-inline" id="userName">Administrator</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="logout()"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="text-center text-white py-3 mb-0">Menu Admin</h5>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#" onclick="loadPage('dashboard')">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadPage('kelola-data-pemagang')">
                    <i class="fas fa-user-graduate"></i>
                    <span>Kelola Data Pemagang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadPage('kelola-penugasan')">
                    <i class="fas fa-tasks"></i>
                    <span>Kelola Penugasan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadPage('kelola-penilaian')">
                    <i class="fas fa-star"></i>
                    <span>Kelola Penilaian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadPage('manajemen-pengguna')">
                    <i class="fas fa-users-cog"></i>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Content will be loaded dynamically -->
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">© 2025 Divisi Teknologi Informasi, Universitas Riau – Sistem Informasi Magang</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="mainToast" class="toast" role="alert">
            <div class="toast-header">
                <i class="fas fa-info-circle text-primary me-2"></i>
                <strong class="me-auto">Sistem Informasi Magang</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                <!-- Message will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auth JS -->
    <script src="../js/auth.js"></script>

    <!-- Content JS -->
    <!-- Auth JS -->
    <script src="../js/auth.js"></script>

    <!-- Content JS -->
    <script src="../js/admin-content.js"></script>

    <!-- Dashboard JS -->
    <script src="../js/dashboard.js"></script>
</body>
</html>

