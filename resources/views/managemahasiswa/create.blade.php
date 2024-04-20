@extends('layouts.app')

@section('title', 'Manage Mahasiswa')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        @if(session('error'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Daftar Nilai AHP Row -->
        <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-6">
            <div class="card">
                <form method="post" action="{{ url('/managemahasiswa') }}">
                @csrf

                <div class="card-header">
                    Form Tambah Mahasiswa
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" class="form-control form-control-user @error('nama_mahasiswa') is-invalid  @enderror" id="nama_mahasiswa" placeholder="Nama Mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}">
                    </div>
                    @error('nama_mahasiswa')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control form-control-user @error('nim') is-invalid  @enderror" id="nim" placeholder="NIM" name="nim" value="{{ old('nim') }}">
                    </div>
                    @error('nim')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    @foreach($kriteria as $kriteriaItem)
                        <div class="form-group">
                            <label for="kriteria_{{ $kriteriaItem->id }}">{{ $kriteriaItem->nama_kriteria }}</label>
                            <input type="text" class="form-control form-control-user @error('kriteria_'.$kriteriaItem->id) is-invalid @enderror" id="kriteria_{{ $kriteriaItem->id }}" placeholder="{{ $kriteriaItem->nama_kriteria }}" name="kriteria_{{ $kriteriaItem->id }}" value="{{ old('kriteria_'.$kriteriaItem->id) }}">
                        </div>
                        @error('kriteria_'.$kriteriaItem->id)
                        <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                        @enderror
                    @endforeach

                </div>

                <div class="card-footer">
                    <a href="{{ url('/managemahasiswa') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Tambah Mahasiswa</button>
                </div>

                </form>

            </div>
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection