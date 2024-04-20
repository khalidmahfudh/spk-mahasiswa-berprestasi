@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-8">
                
                <div class="card border border-secondary mb-4">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('/img/profile/' . Auth::user()->image)}}" class="rounded border border-primary" alt="user-image" style="height: 250px">
                        <h3 class="card-title mt-4">{{ Auth::user()->name }}</h3>
                        <p class="mb-0">{{ Auth::user()->username }} <i>(username)</i></p>
                        <p class="mb-0">{{ Auth::user()->role }} <i>(role)</i></p>
                        <p class="card-text">{{  Auth::user()->email }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ url('/myprofile/editpassword') }}" class="btn btn-danger mr-2"><i class="fas fa-user-lock"></i> Ubah Password</a>
                        <a href="{{ url('/myprofile/editprofile') }}" class="btn btn-primary"><i class="fas fa-user-edit"></i> Ubah Profile</a>
                    </div>
                </div>
            
            </div>
        </div>

        </div>
        <!-- /.container-fluid -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

