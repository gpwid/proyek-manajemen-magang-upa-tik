<nav class="navbar navbar-expand navbar-light bg-white fixed-top shadow-sm py-2 px-3 mb-4" style="">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ms-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-profile rounded-circle me-2" src="{{ asset('asset/img/undraw_profile.svg') }}"
                    alt="Avatar" width="36" height="36">
                <div class="d-none d-lg-block">
                    <div class="small text-muted">Signed in</div>
                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile.edit', [], false) }}">
                    <i class="fas fa-user-cog fa-sm fa-fw me-2 text-muted"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-muted"></i> Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>

</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin mengakhiri sesi Anda?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
