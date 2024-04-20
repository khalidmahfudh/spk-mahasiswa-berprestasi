@extends('layouts.app')

@section('title', 'Bobot Kriteria Topsis')

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
        
        <!-- Daftar Nilai AHP Topsis -->
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
                    <div class="table_container">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
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
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge bg-warning" data-toggle="modal" data-target="#modal_{{ $kriteriaTopsisItem->id }}">
                                        <i class="fas fa-edit"></i>&nbspubah
                                    </button>

                                </td>
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

    </div>
    <!-- /.container-fluid -->


    <!-- Modal Edit Bobot Kriteria -->
    @foreach($kriteriaTopsis as $kriteriaTopsisItem)
    <div class="modal fade" id="modal_{{ $kriteriaTopsisItem->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Ubah Bobot {{ $kriteriaTopsisItem->kriteria->nama_kriteria }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="post" action="{{ url('/bobotkriteriatopsis/'.$kriteriaTopsisItem->id) }}">
            @method('patch')
            @csrf

            <div class="modal-body">

            {{-- Input Bobot Kriteria --}}
            <div class="form-group">
                <label for="bobot">Bobot</label>
                <select class="form-control form-control-user" id="bobot" name="bobot">
                    @foreach($bobot as $item)
                        <option value="{{ $item->id }}" @if(old('bobot', $kriteriaTopsisItem->bobot_id ) == $item->id) selected @endif>{{ ucwords($item->bobot) }} ({{ $item->id }})</option>
                    @endforeach
                </select>
            </div>

            {{-- Input Keterangan Kriteria --}}
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <select class="form-control form-control-user" id="keterangan" name="keterangan">
                        <option value="benefit" @if(old('keterangan', $kriteriaTopsisItem->keterangan ) == 'benefit') selected @endif>Benefit</option>
                        <option value="cost" @if(old('keterangan', $kriteriaTopsisItem->keterangan ) == 'cost') selected @endif>Cost</option>
                </select>
            </div>

            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Ubah Bobot</button>
            </div>

            </form>
        </div>
        </div>
    </div>
    @endforeach
@endsection