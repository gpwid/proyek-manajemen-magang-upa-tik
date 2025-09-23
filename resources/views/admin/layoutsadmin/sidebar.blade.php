<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="
    height: 100vh;
    z-index: 2000;
">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-inline-flex flex-column align-items-center justify-content-center mb-4 mt-3"
        href="index.html">
        <div class="text-xl fw-bold">SIMBA</div>
        <div class="small">Sistem Informasi Bakat Magang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item @yield('internship-active')">
        <a class="nav-link" href="{{ route('admin.internship.index') }}">
            <i class="fa-solid fa-briefcase"></i>
            <span>Kelola Data Magang</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item @yield('penugasan-active')">
        <a class="nav-link" href="{{ route('admin.penugasan.index') }}">
            <i class="fa-solid fa-list-check"></i>
            <span>Kelola Penugasan</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item @yield('permohonan-active')">
        <a class="nav-link" href="{{ route('admin.permohonan.index') }}">
            <i class="fas fa-envelope-open-text"></i>
            <span>Kelola Permohonan</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item @yield('peserta-active')">
        <a class="nav-link" href="{{ route('admin.peserta.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>Kelola Peserta Pemagang</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item @yield('pembimbing-active')">
        <a class="nav-link" href="{{ route('admin.pembimbing.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>Kelola Pembimbing</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item @yield('instansi-active')">
        <a class="nav-link" href="{{ route('admin.instansi.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>Kelola Instansi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
