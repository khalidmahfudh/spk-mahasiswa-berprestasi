@extends('layouts.app')

@section('title', 'Bobot Kriteria AHP')

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
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <a href="{{ url('/matrixkriteriaahp/edit') }}" class="btn btn-primary my-4">Ubah Nilai</a>
                    <div class="table_container" style="overflow-x: auto">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0" >
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

    </div>
    <!-- /.container-fluid -->

@endsection