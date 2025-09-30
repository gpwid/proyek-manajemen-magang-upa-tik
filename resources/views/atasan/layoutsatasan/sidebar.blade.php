{{-- resources/views/atasan/layoutsatasan/sidebar.blade.php --}}
{{--
    Sidebar Khusus ATASAN
    ---------------------
    - File ini hanya berisi menu untuk role Atasan.
    - Gunakan di layout atasan: @include('atasan.layoutsatasan.sidebar')
    - Cara menandai menu aktif: di halaman terkait, set @section('[key]-active', 'active')
      Contoh di halaman Peserta:
        @section('peserta-active', 'active')

    Kunci @yield untuk "active" yang tersedia di sini:
      - dashboard-active
      - permohonan-active
      - internship-active
      - peserta-active
      - pembimbing-active
      - instansi-active
      - penugasan-active

    Catatan icon:
      - Menggunakan Font Awesome 5 (sesuaikan dengan yang kamu load di layout).
--}}

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    {{-- Brand --}}
    <a class="sidebar-brand d-inline-flex flex-column align-items-center justify-content-center mb-4 mt-3"
       href="{{ route('atasan.dashboard.index') }}">
        <div class="text-xl fw-bold">SIMBA</div>
        <div class="small">Sistem Informasi Bakat Magang</div>
    </a>

    <hr class="sidebar-divider my-0">

    {{-- Dashboard --}}
    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('atasan.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    {{-- Heading --}}
    <div class="sidebar-heading">
        Administrasi
    </div>

    {{-- Permohonan --}}
    <li class="nav-item @yield('permohonan-active')">
        <a class="nav-link" href="{{ route('atasan.permohonan.index') }}">
            <i class="fas fa-envelope-open-text"></i>
            <span>Permohonan</span>
        </a>
    </li>

    {{-- Magang --}}
    <li class="nav-item @yield('internship-active')">
        <a class="nav-link" href="{{ route('atasan.internship.index') }}">
            <i class="fa-solid fa-briefcase"></i>
            <span>Magang</span>
        </a>
    </li>

    {{-- Peserta --}}
    <li class="nav-item @yield('peserta-active')">
        <a class="nav-link" href="{{ route('atasan.peserta.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    {{-- Pembimbing --}}
    <li class="nav-item @yield('pembimbing-active')">
        <a class="nav-link" href="{{ route('atasan.pembimbing.index') }}">
            <i class="fa-solid fa-user-tie"></i>
            <span>Pembimbing</span>
        </a>
    </li>

    {{-- Instansi --}}
    <li class="nav-item @yield('instansi-active')">
        <a class="nav-link" href="{{ route('atasan.instansi.index') }}">
            <i class="fa-solid fa-building"></i>
            <span>Instansi</span>
        </a>
    </li>

    {{-- Penugasan (diperbaiki: route sebelumnya keliru ke instansi) --}}
    <li class="nav-item @yield('penugasan-active')">
        <a class="nav-link" href="{{ route('atasan.penugasan.index') }}">
            <i class="fa-solid fa-list-check"></i>
            <span>Penugasan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    {{-- Toggle Sidebar --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
