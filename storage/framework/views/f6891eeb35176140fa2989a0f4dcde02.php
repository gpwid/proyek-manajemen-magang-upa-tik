<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SIMBA - <?php echo $__env->yieldContent('title'); ?></title>

    
    <link href="<?php echo e(asset('asset/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    
    <link href="<?php echo e(asset('asset/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    <style>
        /* Overlay panel untuk sidebar mobile */
        .pembimbing-mobile-sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .35);
            display: none;
            z-index: 1045;
        }

        .pembimbing-mobile-sidebar-overlay.show {
            display: block;
        }

        .pembimbing-mobile-sidebar-panel {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: fit-content;
            max-width: 88vw;
            background: transparent;
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .pembimbing-mobile-sidebar-overlay.show .pembimbing-mobile-sidebar-panel {
            transform: translateX(0);
        }

        /* Desktop: sidebar normal tampil; Mobile: pakai overlay */
        @media (max-width: 991.98px) {
            #pembimbingSidebarDesktopHolder {
                display: none !important;
            }

            #pembimbingOpenSidebarBtn {
                display: inline-flex !important;
            }
        }

        @media (min-width: 992px) {
            #pembimbingOpenSidebarBtn {
                display: none !important;
            }
        }

        /* FIX: sidebar di dalam overlay (matikan sticky & tinggi paksa) */
        .pembimbing-mobile-sidebar-panel .sidebar {
            position: static !important;
            top: auto !important;
            height: 100vh !important;
            overflow-y: auto;
            box-shadow: 0 0 24px rgba(0, 0, 0, .25);
        }

        .pembimbing-mobile-sidebar-panel .sidebar .sidebar-brand {
            margin-top: .25rem;
        }

        #content {
            min-height: 100vh;
        }

        /* Pastikan dropdown di topbar muncul di atas elemen lain */
        .topbar .dropdown-menu {
            z-index: 1051;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar (DESKTOP, gaya SB Admin) -->
        <div id="pembimbingSidebarDesktopHolder" class="d-none d-lg-block">
            <?php echo $__env->make('pembimbing.layoutspembimbing.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar (SB Admin style) -->
                <?php echo $__env->make('pembimbing.layoutspembimbing.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- End of Topbar -->

                <!-- Page Content -->
                <?php echo $__env->yieldContent('content'); ?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer (opsional) -->
            <?php echo $__env->renderWhen(View::exists('pembimbing.layoutspembimbing.footer'),
                'pembimbing.layoutspembimbing.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- ===== MOBILE SIDEBAR OVERLAY ===== -->
    <div id="pembimbingMobileSidebarOverlay" class="pembimbing-mobile-sidebar-overlay" aria-hidden="true">
        <div class="pembimbing-mobile-sidebar-panel" role="dialog" aria-label="Menu">
            
            <?php echo $__env->make('pembimbing.layoutspembimbing.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    <!-- ===== END MOBILE SIDEBAR OVERLAY ===== -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    
    <script src="<?php echo e(asset('asset/vendor/jquery/jquery.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/sb-admin-2.min.js')); ?>"></script>

    
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldContent('scripts'); ?>

    
    <script>
        (function() {
            const overlay = document.getElementById('pembimbingMobileSidebarOverlay');
            const openBtn = document.getElementById('pembimbingOpenSidebarBtn');

            function openSidebar() {
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if (openBtn) openBtn.addEventListener('click', openSidebar);

            // klik di luar panel, tombol, atau link -> tutup
            overlay.addEventListener('click', function(e) {
                const inPanel = e.target.closest('.pembimbing-mobile-sidebar-panel');
                const isClose = e.target.closest('a.nav-link, button, .close, .btn');
                if (!inPanel || (isClose && !e.target.closest('#pembimbingOpenSidebarBtn'))) {
                    closeSidebar();
                }
            });
        })();
    </script>
</body>

</html>
<?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/pembimbing/layoutspembimbing/main.blade.php ENDPATH**/ ?>