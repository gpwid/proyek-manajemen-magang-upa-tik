<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100vh; z-index: 1041;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-3"
        href="<?php echo e(route('pembimbing.dashboard.index') ?? '#'); ?>">
        <div class="sidebar-brand-text mx-3 text-uppercase font-weight-bold">SIMBA</div>
        <div class="small">Panel Pembimbing</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $__env->yieldContent('dashboard-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pembimbing.dashboard.index') ?? '#'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Kelola Magang</div>

    <li class="nav-item <?php echo $__env->yieldContent('peserta-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pembimbing.peserta.index') ?? '#'); ?>">
            <i class="fas fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Administrasi</div>

    <li class="nav-item <?php echo $__env->yieldContent('penugasan-active'); ?>">
        <a class="nav-link" href="<?php echo e(route('pembimbing.task.participants')); ?>">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Penugasan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Desktop) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pembimbing/layoutspembimbing/sidebar.blade.php ENDPATH**/ ?>