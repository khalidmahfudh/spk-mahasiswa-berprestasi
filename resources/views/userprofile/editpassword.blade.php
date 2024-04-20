@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        @if(session('error'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- /.row -->
        <div class="row">
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        Form Edit Password
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('/myprofile/updatepassword') }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current_password">Password Saat Ini</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle_current_password" onclick="togglePasswordVisibility('current_password')">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('current_password')
                                    <p class="text-danger font-italic" style="font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle_new_password" onclick="togglePasswordVisibility('new_password')">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('new_password')
                                    <p class="text-danger font-italic" style="font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle_new_password_confirmation" onclick="togglePasswordVisibility('new_password_confirmation')">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('new_password_confirmation')
                                    <p class="text-danger font-italic" style="font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ url('/myprofile') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Edit Password</button>
                </div>
            </form>
        </div>

    </div>

    </div>
    <!-- /.container-fluid -->

@endsection