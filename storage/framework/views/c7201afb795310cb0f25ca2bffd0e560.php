<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow topbar">

    
    <button id="pembimbingOpenSidebarBtn" class="btn btn-link d-lg-none rounded-circle mr-3" type="button" title="Menu">
        <i class="fa fa-bars"></i>
    </button>

    
    <h1 class="h6 mb-0 text-gray-800 d-none d-lg-inline">Panel Pembimbing</h1>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ms-auto">

        
        <div class="topbar-divider d-none d-sm-block"></div>

        
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <span class="me-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo e(Auth::user()->name ?? 'User'); ?>

                </span>
                <img class="img-profile rounded-circle"
                     src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name ?? 'User')); ?>&background=4F46E5&color=fff"
                     alt="avatar" style="width: 32px; height: 32px;">
            </a>

            <!-- Dropdown - User Information -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                        Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="<?php echo e(route('logout') ?? '#'); ?>" method="POST" class="m-0 p-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<?php /**PATH C:\laragon\www\magang\resources\views/pembimbing/layoutspembimbing/navbar.blade.php ENDPATH**/ ?>