@extends('layouts.app')

@section('title', 'Manage Kriteria')

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
                <form method="post" action="{{ url('/managekriteria/'.$kriteria->id) }}">
                @method('patch')
                @csrf

                <div class="card-header">
                    Form Ubah Kriteria {{ $kriteria->nama_kriteria }}
                </div>

                <div class="card-body">

                    {{-- Input Nama Kriteria --}}
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" class="form-control form-control-user @error('nama_kriteria') is-invalid  @enderror" id="nama_kriteria" placeholder="Nama Kriteria" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}">
                    </div>
                    @error('nama_kriteria')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    {{-- Input Kode Kriteria --}}
                    <div class="form-group">
                        <label for="kode_kriteria">Kode Kriteria</label>
                        <select class="form-control form-control-user @error('kode_kriteria') is-invalid  @enderror" id="kode_kriteria" name="kode_kriteria">
                            @foreach($availableKodes as $kode)
                                <option value="{{ $kode }}" @if(old('kode_kriteria', $kriteria->kode_kriteria) == $kode) selected @endif>{{ $kode }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('kode_kriteria')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    {{-- Input Nilai Kriteria --}}
                    <div class="form-group">
                        <label for="bilangan">Bilangan (Nilai Kriteria)</label>
                        <select class="form-control form-control-user @error('bilangan') is-invalid  @enderror" id="bilangan" name="bilangan">
                            <option value="bulat" @if(old('bilangan', $kriteria->bilangan) == 'bulat') selected @endif>Bulat</option>
                            <option value="pecahan" @if(old('bilangan', $kriteria->bilangan) == 'pecahan') selected @endif>Pecahan</option>
                        </select>
                    </div>
                    @error('bilangan')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror

                    {{-- Input Minimum Nilai Kriteria --}}
                    <div class="form-group">
                        <label for="min_nilai">Minimum Nilai diberikan</label>
                        <input type="text" class="form-control form-control-user @error('min_nilai') is-invalid  @enderror" id="min_nilai" placeholder="misal = 0" name="min_nilai" value="{{ old('min_nilai', $kriteria->min_nilai) }}">
                    </div>
                    @error('min_nilai')
                    <p class="text-danger font-italic mt-n2" style="font-size= .9rem">{{ $message }}</p>
                    @enderror

                    {{-- Input Maksimum Nilai Kriteria --}}
                    <div class="form-group">
                        <label for="max_nilai">Maksimum Nilai diberikan</label>
                        <input type="text" class="form-control form-control-user @error('max_nilai') is-invalid  @enderror" id="max_nilai" placeholder="misal = 10" name="max_nilai" value="{{ old('max_nilai', $kriteria->max_nilai) }}">
                    </div>
                    @error('max_nilai')
                    <p class="text-danger font-italic mt-n2" style="font-size: .9rem">{{ $message }}</p>
                    @enderror
                    
                </div>

                <div class="card-footer">
                    <a href="{{ url('/managekriteria') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Ubah Kriteria</button>
                </div>

                </form>

            </div>
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection