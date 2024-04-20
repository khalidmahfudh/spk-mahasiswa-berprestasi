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
                        Form Edit Profile
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('/myprofile/updateprofile') }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="name">Username Login</label>
                            <input type="text" class="form-control @error('username') is-invalid  @enderror" id="name" name="username" value="{{ $user->username }}">
                        </div>
                        @error('username')
                            <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputFile">Picture</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{ asset('/img/profile/'. $user->image)}}" class="img-thumbnail" id="profile-image">
                                </div>
                                <div class="input-group col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid  @enderror" id="file" name="file">
                                        <label class="custom-file-label" for="file" id="file-label">{{ $user->image }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('file')
                            <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                        @enderror
                    </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ url('/myprofile') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Edit Profile</button>
                </div>
            </form>
        </div>

    </div>

    </div>
    <!-- /.container-fluid -->

@endsection