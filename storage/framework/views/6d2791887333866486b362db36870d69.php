


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    
    <a class="sidebar-brand d-inline-flex flex-column align-items-center justify-content-center mb-4 mt-3"
       href="<?php echo e(route('atasan.dashboard.index')); ?>">
        <div class="text-xl fw-bold">SIMBA</div>
        <div class="small">Sistem Informasi Bakat Magang</div>
    </a>

    <hr class="sidebar-divider my-0">

    
    <li class="nav-item <?php echo $__env->yieldContent('dashboard-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.dashboard.index')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    
    <div class="sidebar-heading">
        Administrasi
    </div>

    
    <li class="nav-item <?php echo $__env->yieldContent('permohonan-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.permohonan.index')); ?>">
            <i class="fas fa-envelope-open-text"></i>
            <span>Permohonan</span>
        </a>
    </li>

    
    <li class="nav-item <?php echo $__env->yieldContent('internship-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.internship.index')); ?>">
            <i class="fa-solid fa-briefcase"></i>
            <span>Magang</span>
        </a>
    </li>

    
    <li class="nav-item <?php echo $__env->yieldContent('peserta-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.peserta.index')); ?>">
            <i class="fa-solid fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    
    <li class="nav-item <?php echo $__env->yieldContent('pembimbing-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.pembimbing.index')); ?>">
            <i class="fa-solid fa-user-tie"></i>
            <span>Pembimbing</span>
        </a>
    </li>

    
    <li class="nav-item <?php echo $__env->yieldContent('instansi-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.instansi.index')); ?>">
            <i class="fa-solid fa-building"></i>
            <span>Instansi</span>
        </a>
    </li>

    
    <li class="nav-item <?php echo $__env->yieldContent('penugasan-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('atasan.penugasan.index')); ?>">
            <i class="fa-solid fa-list-check"></i>
            <span>Penugasan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php /**PATH C:\laragon\www\magang\resources\views/atasan/layoutsatasan/sidebar.blade.php ENDPATH**/ ?>