@extends('layouts.app')

@section('title', 'Manage Mahasiswa')

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
                    <a href="{{ url('/managemahasiswa/create') }}" class="btn btn-primary my-4">Tambah Mahasiswa</a>
                    <div class="table_container">
                        
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                @foreach($kriteria as $kriteriaItem)
                                <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                @endforeach
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $mhs)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nama_mahasiswa }}</td>
                                <td>{{ $mhs->nim }}</td>
                                @foreach($kriteria  as $kriteriaItem)
                                <td>{{ \App\Models\NilaiKriteriaMahasiswa::where('mahasiswa_id', $mhs->id)->where('kriteria_id', $kriteriaItem->id)->first()->nilai }}</td>
                                @endforeach
                                <td class="d-flex">

                                    <form action="{{ url('/managemahasiswa/'. $mhs->id .'/edit') }}" method="get" class="d-inline mr-2">
                                            <button type="submit" class="badge bg-warning"><i class="fas fa-edit"></i>&nbspubah</button>
                                    </form>

                                    <form action="{{ url('/managemahasiswa/'. $mhs->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger"><i class="fas fa-trash"></i>&nbsphapus</button>
                                    </form>

                                </td>
                                </tr>
                                @endforeach
                                @if (!$mahasiswa)
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">Belum ada mahasiswa yang tersedia. Silakan tambahkan mahasiswa terlebih dahulu.</td>
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

@endsection