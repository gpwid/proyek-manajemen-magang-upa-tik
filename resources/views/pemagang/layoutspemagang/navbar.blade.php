@php
    // Ambil user dari guard admin jika ada, kalau tidak pakai default
    $user = Auth::user();
    $name = $user?->name ?? 'Guest';
    $avatar = $user?->avatar_url ?? null;
    $initial = mb_strtoupper(mb_substr($name, 0, 1));
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom" style="
margin-bottom: 12pt;
">
    <div class="container-fluid">
        {{-- Brand --}}
        <div class="navbar-brand fw-semibold">@yield('title')</div>

        {{-- Toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbarNav"
            aria-controls="topbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nav Content --}}
        <div class="collapse navbar-collapse" id="topbarNav">

            {{-- User Menu --}}
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if ($avatar)
                            <img src="{{ $avatar }}" alt="avatar" width="32" height="32"
                                class="rounded-circle me-2" style="object-fit: cover;">
                        @else
                            <span
                                class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center me-2"
                                style="width:32px;height:32px;">{{ $initial }}</span>
                        @endif
                        <span class="fw-medium">{{ $name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @auth
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Keluar</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Masuk</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
