<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-3"
       href="{{ route('pembimbing.dashboard.index') ?? '#' }}">
        <div class="sidebar-brand-text mx-3 text-uppercase font-weight-bold">SIMBA</div>
        <div class="small">Panel Pembimbing</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('pembimbing.dashboard.index') ?? '#' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Kelola Magang</div>

    <li class="nav-item @yield('peserta-active')">
        <a class="nav-link" href="{{ route('pembimbing.peserta.index') ?? '#' }}">
            <i class="fas fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Administrasi</div>

    <li class="nav-item @yield('penugasan-active')">
        <a class="nav-link" href="#">
            <i class="fas fa-list-check"></i>
            <span>Penugasan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Desktop) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
