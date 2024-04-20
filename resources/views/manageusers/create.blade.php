@extends('layouts.app')

@section('title', 'Manage Users')

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

        <!-- Daftar Nilai AHP Row -->
        <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-6">
            <div class="card">
                <form method="post" action="{{ url('/manageusers') }}">
                @csrf

                <div class="card-header">
                    Form Tambah User
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama User</label>
                        <input type="text" class="form-control form-control-user @error('name') is-invalid  @enderror" id="name" placeholder="Nama User" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="username">Username Akun</label>
                        <input type="text" class="form-control form-control-user @error('username') is-invalid  @enderror" id="username" placeholder="Username" name="username" value="{{ old('username') }}">
                    </div>
                    @error('username')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid  @enderror" id="email" placeholder="email@mail.com" name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" class="form-control @error('role') is-invalid  @enderror" name="role">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                        </select>
                    </div>
                    @error('role')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="is_active">Akun Aktif</label>
                        <select id="is_active" class="form-control @error('is_active') is-invalid  @enderror" name="is_active">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    @error('is_active')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user @error('password') is-invalid  @enderror" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid  @enderror" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    @error('password_confirmation')
                        <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror
                    
                </div>

                <div class="card-footer">
                    <a href="{{ url('/manageusers') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Tambah User</button>
                </div>

                </form>

            </div>
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection