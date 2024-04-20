@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Daftar Mahasiswa -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Table {{ $title }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <a href="{{ url('/manageusers/create') }}" class="btn btn-primary my-4">Tambah User</a>
                    <div class="table_container">
                        
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->is_active? 'Aktif':'Tidak Aktif' }}</td>
                                <td class="d-flex">

                                    <form action="{{ url('/manageusers/'. $user->id .'/edit') }}" method="get" class="d-inline mr-2">
                                            <button type="submit" class="badge bg-success"><i class="fas fa-edit"></i>&nbspubah</button>
                                    </form>

                                    <form action="{{ url('/manageusers/'. $user->id) }}" method="post" class="d-inline mr-2">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger"><i class="fas fa-trash"></i>&nbsphapus</button>
                                    </form>

                                    <div>
                                        <button type="button" class="badge bg-secondary detail-button" data-toggle="modal" data-target="#detailModal" data-id="{{ $user->id }}">
                                            <i class="fas fa-info-circle"></i>&nbspdetail
                                        </button>
                                    </div>



                                </td>
                                </tr>
                                @endforeach
                                @if (!$users)
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">Belum ada user yang tersedia. Silakan tambahkan user terlebih dahulu.</td>
                                    </tr>
                                @endif
                            </tbody>
                            </table>
                        </div>
                </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModal" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control" id="detail-name" disabled>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="detail-username" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="detail-email" disabled>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="detail-role" disabled>
                </div>
                <div class="form-group">
                    <label for="active">Aktif</label>
                    <input type="text" class="form-control" id="detail-active" disabled>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>


@endsection