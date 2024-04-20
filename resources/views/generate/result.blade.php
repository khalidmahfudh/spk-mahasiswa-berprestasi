@extends('layouts.app')

@section('title', 'Hasil Generate Peringkat')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title['main'] }}</h1>
        </div>

        <!-- Hasil Preferensi AHP -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Table {{ $title['ahp'] }}</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table_container">
                        
                        <table class="table table-bordered text-center dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Ranking</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nilai Preferensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($preferensiAhp as $row)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($row->mahasiswa->nama_mahasiswa) }}</td>
                                <td>{{ $row->preferensi }}</td>
                                </tr>
                                @endforeach
                                @if (!$preferensiAhp)
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">Belum ada data yang tersedia. Silakan lakukan generate terlebih dahulu.</td>
                                    </tr>
                                @endif
                            </tbody>
                            </table>
                        </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Hasil Preferensi TOPSIS -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Table {{ $title['topsis'] }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table_container">
                        
                        <table class="table table-bordered text-center dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Ranking</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nilai Preferensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($preferensiTopsis as $row)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($row->mahasiswa->nama_mahasiswa) }}</td>
                                <td>{{ $row->preferensi }}</td>
                                </tr>
                                @endforeach
                                @if (!$preferensiTopsis)
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">Belum ada data yang tersedia. Silakan lakukan generate terlebih dahulu.</td>
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