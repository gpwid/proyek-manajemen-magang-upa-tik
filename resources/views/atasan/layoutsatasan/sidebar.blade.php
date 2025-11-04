<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-3"
        href="{{ route('atasan.dashboard.index') ?? '#' }}">
        <div class="sidebar-brand-text mx-3 text-uppercase font-weight-bold">SIMBA</div>
        <div class="small">Panel Atasan</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('atasan.dashboard.index') ?? '#' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Kelola Magang</div>

    <li class="nav-item @yield('permohonan-active')">
        <a class="nav-link" href="{{ route('atasan.permohonan.index') ?? '#' }}">
            <i class="fas fa-envelope-open-text"></i>
            <span>Permohonan</span>
        </a>
    </li>

    <li class="nav-item @yield('internship-active')">
        <a class="nav-link" href="{{ route('atasan.internship.index') ?? '#' }}">
            <i class="fas fa-briefcase"></i>
            <span>Magang</span>
        </a>
    </li>

    <li class="nav-item @yield('peserta-active')">
        <a class="nav-link" href="{{ route('atasan.peserta.index') ?? '#' }}">
            <i class="fas fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Administrasi</div>

    <li class="nav-item @yield('pembimbing-active')">
        <a class="nav-link" href="{{ route('atasan.pembimbing.index') ?? '#' }}">
            <i class="fas fa-user-tie"></i>
            <span>Pembimbing</span>
        </a>
    </li>

    <li class="nav-item @yield('instansi-active')">
        <a class="nav-link" href="{{ route('atasan.instansi.index') ?? '#' }}">
            <i class="fas fa-building"></i>
            <span>Instansi</span>
        </a>
    </li>

    <li class="nav-item @yield('penugasan-active')">
        <a class="nav-link" href="{{ route('atasan.penugasan.index') ?? '#' }}">
            <i class="fas fa-list-check"></i>
            <span>Penugasan</span>
        </a>
    </li>

    <li class="nav-item @yield('changelog-active')">
        <a class="nav-link" href="{{ route('atasan.changelog.index') }}">
            <i class="fa-solid fa-file-alt"></i>
            <span>Changelog</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Desktop) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
