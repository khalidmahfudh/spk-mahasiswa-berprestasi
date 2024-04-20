@extends('layouts.app')

@section('title', 'Bobot Kriteria AHP')

@section('content')

<style>
    [data-toggle="buttons"]>.btn>input[type="radio"] {
    display: none;
    }
</style>

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
                <div class="table_container">
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <form method="post" action="{{ url('/matrixkriteriaahp') }}">
                            @method('patch')
                            @csrf
                        <thead>
                            <tr>
                                <th colspan="3">Nilai Perbandingan Antar Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            

                            @foreach($compKriteria as $item)
                            <tr>
                                <th>{{ $item->kriteria_x->nama_kriteria }}</th>
                                <td>
                                    <div class="btn-group" data-toggle="buttons">

                                        @php $n = 10; @endphp
                                        @for ($i = $n - 1; $i > -$n; $i--) 
                                            @if($i == 0 || $i == -1 ) @continue @endif

                                            @php 
                                                $nilai = $item->nilai;
                                                $nilai = ($nilai >= 1)? $nilai : -(round(1 / $nilai));
                                            @endphp

                                            <label class="btn btn-primary @if($nilai == $i) active @endif">
                                                <input type="radio" name="perbandingan_{{ $item->kriteria_id_sumbu_x . '_' . $item->kriteria_id_sumbu_y }}" value='{{ $item->kriteria_id_sumbu_x . '_' . $item->kriteria_id_sumbu_y . '_' . $i }}' @if($nilai == $i) checked @endif>{{ abs($i) }}
                                            </label>
                                        @endfor

                                    </div>
                                </td>
                                <th>{{ $item->kriteria_y->nama_kriteria }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"><button type="submit" class="btn btn-primary float-right">ubah</button></th>
                            </tr>
                        </tfoot>
                        </form>
                        </table>
                    </div>
            </div>
            </div>
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection