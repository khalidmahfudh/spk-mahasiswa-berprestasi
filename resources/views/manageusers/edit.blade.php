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
                <form method="post" action="{{ url('/manageusers/'.$user->id) }}">
                @method('patch')
                @csrf

                <div class="card-header">
                    Form Ubah User {{ $user->name}}
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama User</label>
                        <input type="text" class="form-control form-control-user @error('name') is-invalid  @enderror" id="name" placeholder="Nama User" name="name" value="{{ old('name', $user->name) }}">
                    </div>
                    @error('name')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="username">Username Akun</label>
                        <input type="text" class="form-control form-control-user @error('username') is-invalid  @enderror" id="username" placeholder="Username" name="username" value="{{ old('username', $user->username) }}">
                    </div>
                    @error('username')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid  @enderror" id="email" placeholder="email@mail.com" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                    @error('email')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" class="form-control" name="role">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>user</option>
                        </select>
                    </div>
                    @error('role')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="is_active">Akun Aktif</label>
                        <select id="is_active" class="form-control" name="is_active">
                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    @error('is_active')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="password">Perbarui Password</label>
                        <input type="password" class="form-control form-control-user @error('password') is-invalid  @enderror" id="password" placeholder="Password baru" name="password" >
                    </div>
                    @error('password')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                </div>

                <div class="card-footer">
                    <a href="{{ url('/manageusers') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Ubah User</button>
                </div>

                </form>

            </div>
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection