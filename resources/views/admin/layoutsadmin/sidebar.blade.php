<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    <a class="sidebar-brand d-inline-flex flex-column align-items-center justify-content-center mb-4 mt-3"
        href="{{ route('admin.dashboard.index') }}">
        <div class="text-xl fw-bold">SIMBA</div>
        <div class="small">Sistem Informasi Bakat Magang</div>
    </a>

    <hr class="sidebar-divider my-0">

    {{-- =================================================== --}}
    {{-- MENU UNTUK SEMUA ROLE YANG LOGIN (Admin, Atasan, Pembimbing) --}}
    {{-- =================================================== --}}

    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- =================================================== --}}
    {{-- MENU KHUSUS UNTUK ROLE ADMIN & PEMBIMBING --}}
    {{-- =================================================== --}}
    @if (Auth::user()->isAdmin() || Auth::user()->isPembimbing())
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Manajemen Magang
        </div>

        <li class="nav-item @yield('internship-active')">
            <a class="nav-link" href="{{ route('admin.internship.index') }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Data Magang</span>
            </a>
        </li>

        <li class="nav-item @yield('penugasan-active')">
            <a class="nav-link" href="{{ route('admin.penugasan.index') }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Penugasan</span>
            </a>
        </li>

        <li class="nav-item @yield('qrcode-active')">
            <a class="nav-link" href="{{ route('admin.attendance.qrcode') }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>QR Code Absensi</span>
            </a>
        </li>
    @endif

    {{-- =================================================== --}}
    {{-- MENU KHUSUS UNTUK ROLE ADMIN --}}
    {{-- =================================================== --}}
    @if (Auth::user()->isAdmin())
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Administrasi
        </div>

        <li class="nav-item @yield('permohonan-active')">
            <a class="nav-link" href="{{ route('admin.permohonan.index') }}">
                <i class="fas fa-envelope-open-text"></i>
                <span>Kelola Permohonan</span>
            </a>
        </li>

        <li class="nav-item @yield('peserta-active')">
            <a class="nav-link" href="{{ route('admin.peserta.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Kelola Peserta</span>
            </a>
        </li>

        <li class="nav-item @yield('pembimbing-active')">
            <a class="nav-link" href="{{ route('admin.pembimbing.index') }}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Kelola Pembimbing</span>
            </a>
        </li>

        <li class="nav-item @yield('instansi-active')">
            <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                <i class="fa-solid fa-building"></i>
                <span>Kelola Instansi</span>
            </a>
        </li>

        <li class="nav-item @yield('users-active')">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa-solid fa-users-gear"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
    @endif

    {{-- =================================================== --}}
    {{-- MENU KHUSUS UNTUK ROLE PEMAGANG (Contoh) --}}
    {{-- =================================================== --}}
    @if (Auth::user()->isPemagang())
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Aktivitas Saya
        </div>

        <li class="nav-item">
            <a class="nav-link" href="#"> {{-- Arahkan ke route logbook nanti --}}
                <i class="fas fa-book-open"></i>
                <span>Logbook Harian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"> {{-- Arahkan ke route absensi nanti --}}
                <i class="fas fa-fingerprint"></i>
                <span>Absensi</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
