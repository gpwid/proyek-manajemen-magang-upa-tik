<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?php echo e(route('pemagang.dashboard.index') ?? '#'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMBA Pemagang</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?php echo $__env->yieldContent('dashboard-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pemagang.dashboard.index')); ?>"> 
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Aktivitas Saya
    </div>

    <li class="nav-item <?php echo $__env->yieldContent('logbook-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pemagang.logbook.index')); ?>"> 
            <i class="fas fa-book-open"></i>
            <span>Logbook Harian</span>
        </a>
    </li>
    <li class="nav-item <?php echo $__env->yieldContent('absensi-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pemagang.attendance.index')); ?>"> 
            <i class="fas fa-fingerprint"></i>
            <span>Absensi</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pemagang/layoutspemagang/sidebar.blade.php ENDPATH**/ ?>