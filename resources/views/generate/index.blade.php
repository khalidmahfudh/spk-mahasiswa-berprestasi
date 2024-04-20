@extends('layouts.app')

@section('title', 'Generate Peringkat')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        <!-- Daftar Mahasiswa -->
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
                </div>
                </div>
            </div>
        </div>

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
                    <div class="table_container" style="overflow-x: scroll">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" >
                            <thead>
                                <tr>
                                <th class="d-none">No</th>
                                <th>Kriteria</th>
                                @foreach($kriteria as $kriteriaItem)
                                    <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $kriteriaItem)
                                <tr>
                                <td class="d-none">{{ $loop->iteration }}</td>
                                <th>{{ $kriteriaItem->nama_kriteria }}</th>

                                @php 
                                    $kriteria_x = \App\Models\KriteriaAHP::where('kriteria_id_sumbu_x', $kriteriaItem->id)->get();
                                @endphp

                                @foreach($kriteria_x as $kriteria_x_item)
                                    <td>{{ $kriteria_x_item->nilai }}</td>
                                @endforeach

                                </tr>
                                @endforeach

                                @if (!$kriteriaAhp)
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

        <!-- Daftar Nilai AHP Topsis -->
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
                    <div class="table_container">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteriaTopsis as $kriteriaTopsisItem)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kriteriaTopsisItem->kriteria->kode_kriteria }}</td>
                                <td>{{ $kriteriaTopsisItem->kriteria->nama_kriteria }}</td>
                                <td>{{ ucwords($kriteriaTopsisItem->bobot->bobot) }}</td>
                                <td>{{ ucwords($kriteriaTopsisItem->keterangan) }}</td>
                                </tr>
                                @endforeach
                                @if (!$kriteriaTopsis)
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

        <div class="row">
            <div class="col-md text-center my-5">
                <form action="/generate/process" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Generate Peringkat</button>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showProcess" value="1" name="showProcess">
                        <label class="form-check-label" for="showProcess">Tampilkan Proses</label>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection