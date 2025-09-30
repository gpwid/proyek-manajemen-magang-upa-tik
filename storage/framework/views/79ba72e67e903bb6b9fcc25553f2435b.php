<?php
    // Ambil user dari guard atasan jika ada, kalau tidak pakai default
    $user = Auth::user();
    $name = $user?->name ?? 'Guest';
    $avatar = $user?->avatar_url ?? null;
    $initial = mb_strtoupper(mb_substr($name, 0, 1));
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom" style="
margin-bottom: 12pt;
">
    <div class="container-fluid">
        
        <div class="navbar-brand fw-semibold"><?php echo $__env->yieldContent('title'); ?></div>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbarNav"
            aria-controls="topbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="topbarNav">

            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if($avatar): ?>
                            <img src="<?php echo e($avatar); ?>" alt="avatar" width="32" height="32"
                                class="rounded-circle me-2" style="object-fit: cover;">
                        <?php else: ?>
                            <span
                                class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center me-2"
                                style="width:32px;height:32px;"><?php echo e($initial); ?></span>
                        <?php endif; ?>
                        <span class="fw-medium"><?php echo e($name); ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="<?php echo e(route('atasan.profile.edit')); ?>">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if(auth()->guard()->check()): ?>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Keluar</button>
                                </form>
                            </li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('login')); ?>">Masuk</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\magang\resources\views/atasan/layoutsatasan/navbar.blade.php ENDPATH**/ ?>