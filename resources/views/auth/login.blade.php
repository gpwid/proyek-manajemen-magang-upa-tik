<x-guest-layout>
    @section('title', 'Login')

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
    </div>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="user" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="identifier" name="identifier"
                value="{{ old('identifier') }}" required autofocus placeholder="Masukkan NIM/NIS/NIP/Email...">
        </div>

        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" required
                placeholder="Password">
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                <label class="custom-control-label" for="remember_me">Ingat Saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        @if (Route::has('password.request'))
            <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
        @endif
    </div>
    <div class="text-center">
        <a class="small" href="{{ route('participant.register') }}">Buat Akun (Untuk pemagang)</a>
    </div>
</x-guest-layout>
