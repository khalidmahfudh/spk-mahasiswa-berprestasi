@extends('authLayouts.app')

@section('title', 'Halaman Login')

@section('content')

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-md-5">

    <div class="card o-hidden border-0 shadow-lg my-5">

        @if(isset($error))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif

        @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                </div>

                <form class="user" method="post" action="{{ url('/login') }}">

                @csrf

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" placeholder="Username atau Email" name="username_email" value="{{ old('username_email') }}">
                </div>
                @error('username_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember-me">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>

                <hr>
                </form>
                <div class="text-center">
                <a class="small" href="forgot-password.html">Lupa Password?</a>
                </div>
                <div class="text-center">
                <a class="small" href="/register">Registrasi Akun Baru!</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    </div>

</div>

</div>

@endsection
