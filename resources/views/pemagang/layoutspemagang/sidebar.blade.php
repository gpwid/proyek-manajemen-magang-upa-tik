<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMBA Pemagang</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="#"> {{-- Arahkan ke route dashboard pemagang nanti --}}
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Aktivitas Saya
    </div>

    <li class="nav-item @yield('logbook-active')">
        <a class="nav-link" href="#"> {{-- Arahkan ke route logbook nanti --}}
            <i class="fas fa-book-open"></i>
            <span>Logbook Harian</span>
        </a>
    </li>
    <li class="nav-item @yield('absensi-active')">
        <a class="nav-link" href="#"> {{-- Arahkan ke route absensi nanti --}}
            <i class="fas fa-fingerprint"></i>
            <span>Absensi</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
