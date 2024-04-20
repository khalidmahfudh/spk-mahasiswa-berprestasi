@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Jumlah Mahasiswa Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Mahasiswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswa->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Jumlah Kriteria Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kriteria Penilaian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteria->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list-ol fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>

        <!-- Daftar Mahasiswa -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Table Nilai Mahasiswa</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
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

                        <div class="text-center">
                            <a href="{{ url('/managemahasiswa') }}" class="btn btn-primary m-3">Edit Nilai Mahasiswa</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection