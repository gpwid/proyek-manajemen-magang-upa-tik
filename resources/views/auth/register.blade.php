<x-guest-layout>
    @section('title', 'Register')

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="user" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="name" name="name"
                value="{{ old('name') }}" required autofocus placeholder="Nama Lengkap">
        </div>

        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email"
                value="{{ old('email') }}" required placeholder="Alamat Email">
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="password" name="password" required
                    placeholder="Password">
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="password_confirmation"
                    name="password_confirmation" required placeholder="Ulangi Password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-user btn-block">
            Register Akun
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('login') }}">Sudah punya akun? Login!</a>
    </div>
</x-guest-layout>
