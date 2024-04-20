@extends('layouts.app')

@section('title', 'Manage Kriteria')

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
        
        <!-- Daftar Nilai AHP Row -->
        <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-8">
            <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Table {{ $title }}</h6>
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="{{ url('/managekriteria/create') }}" class="btn btn-primary my-4">Tambah Kriteria</a>
                <div class="table_container">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bilangan (Nilai Kriteria)</th>
                            <th>Minimum Nilai diberikan</th>
                            <th>Maksimum Nilai diberikan</th>

                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriteria as $kriteriaItem)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kriteriaItem->kode_kriteria }}</td>
                            <td>{{ $kriteriaItem->nama_kriteria }}</td>
                            <td>{{ $kriteriaItem->bilangan }}</td>
                            <td>{{  $kriteriaItem->bilangan == 'bulat' ?  $kriteriaItem->min_nilai : number_format($kriteriaItem->min_nilai, 2) }}</td>
                            <td>{{  $kriteriaItem->bilangan == 'bulat' ?  $kriteriaItem->max_nilai : number_format($kriteriaItem->max_nilai, 2) }}</td>
                            <td class="d-flex">

                                <form action="{{ url('/managekriteria/'. $kriteriaItem->id .'/edit') }}" method="get" class="d-inline mr-2">
                                        <button type="submit" class="badge bg-warning"><i class="fas fa-edit"></i>&nbspubah</button>
                                </form>

                                <form action="{{ url('/managekriteria/'. $kriteriaItem->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="badge bg-danger"><i class="fas fa-trash"></i>&nbsphapus</button>
                                </form>

                            </td>
                            </tr>
                            @endforeach
                            @if (!$kriteria)
                                <tr>
                                    <td colspan="3" class="text-center text-danger">Belum ada kriteria yang tersedia. Silakan tambahkan kriteria terlebih dahulu.</td>
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