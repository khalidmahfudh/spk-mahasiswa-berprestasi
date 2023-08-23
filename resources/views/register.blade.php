@extends('authLayouts.app')

@section('title', 'Halaman Registrasi')

@section('content')

<div class="container">

  <div class="row justify-content-center">

    <div class="col-md-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Halaman Registrasi</h1>
              </div>

              <form class="user" method="post" action="{{ url('/register') }}">

                @csrf

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email">
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">Registrasi</button>

              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ url('/login') }}">Sudah melakukan registrasi? Silahkan Login!</a>
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