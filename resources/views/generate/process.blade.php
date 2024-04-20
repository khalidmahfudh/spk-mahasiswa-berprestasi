@extends('layouts.app')

@section('title', 'Proses Generate Peringkat')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        <h1 class="h4 mb-0 text-gray-800"># Metode AHP</h1>

        <p>1. Menetapkan prioritas elemen, membandingkan masing-masing kriteria dan mencari nilai total masing-masing kolom</p>

        @php dump($processAhp['nilaiPerbandinganKriteria']); @endphp

        <div class="table-container" style="overflow-x: scroll">
            <table class="table table-bordered text-center">
                <thead>
                    <th>Kriteria</th>
                    @foreach($processAhp['kriteria'] as $kriteria)
                    <th>{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($processAhp['nilaiPerbandinganKriteria'] as $row)
                    <tr>
                        <th>{{ $processAhp['kriteria'][$loop->index]->nama_kriteria }}</th>
                        @foreach($row as $column)
                        <td>{{ $column }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Jumlah</th>
                        @foreach($processAhp['sumNilaiPerbandinganKriteria'] as $item)
                        <td class="font-weight-bold">{{ $item }}</td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>

        <p>1.2. Sintesis Nilai Perbandingan Kriteria</p>
        <p>// nilai eigen = masing2 nilai perbandingan / masing2 jumlah kolom nilai perbandingan kriteria </p>
        @php dump($processAhp['nilaiEigenPerbandinganKriteria']); @endphp

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <th>Kriteria</th>
                    @foreach($processAhp['kriteria'] as $kriteria)
                    <th>{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                    <th>Jumlah</th>
                    <th>Rata-rata</th>
                </thead>
                <tbody>
                    @foreach($processAhp['nilaiEigenPerbandinganKriteria'] as $row)
                    <tr>
                        <th>{{ $processAhp['kriteria'][$loop->index]->nama_kriteria }}</th>
                        @foreach($row as $column)
                        <td>{{ $column }}</td>
                        @endforeach
                        <th>{{ $processAhp['sumAvgNilaiEigenBarisPerbandinganKriteria'][$loop->index]['sum'] }}</th>
                        <th>{{ $processAhp['sumAvgNilaiEigenBarisPerbandinganKriteria'][$loop->index]['avg'] }}</th>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="{{ count($processAhp['kriteria']) + 2 }}">Jumlah</th>
                        <td class="font-weight-bold">{{ $processAhp['totalAvgNilaiEigenBarisPerbandinganKriteria'] }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <p>1.3. Menghitung Nilai CI(Consistency Index) dan CR(Consistency Ratio)</p>
        <p>// λ (lamda)maks = (jumlah kolom kriteria1 x rata_rata baris kriteria1)+(jumlah kolom kriteria2 x rata_rata baris kriteria2)+ ⋯ n.</p>
        <p>λ (lamda)maks = {{ $processAhp['lamdaMaksKriteria'] }}</p>
        <br>
        <p>// CI = (λ (lamda) maks - n) / (n-1)</p>
        <p>// n = {{ count($processAhp['kriteria']) }} (jumlah kriteria)</p>
        <p>CI =({{ $processAhp['lamdaMaksKriteria'] }} - {{ count($processAhp['kriteria']) }}) / ({{ count($processAhp['kriteria']) }} - 1) = {{ $processAhp['CI_Kriteria'] }}</p>

        <p>// CR = CI / IR</p>
        <p>IR = {{ $processAhp['IR_Kriteria'] }} (Lihat di tabel nilai Index Ratio)</p>
        <p>CR = {{ $processAhp['CI_Kriteria'] }} / {{ $processAhp['IR_Kriteria'] }} = {{ $processAhp['CR_Kriteria'] }} ({{ ($processAhp['CR_Kriteria'] <= 0.1)? 'konsisten < 0.1':'Tidak Konsisten > 0.1' }})</p> 

        @php dump($processAhp['nilaiPerbandinganAlternatif']); @endphp
        @php dump($processAhp['nilaiEigenPerbandinganAlternatif']); @endphp

        @php $numb = 2; @endphp
        @foreach($processAhp['nilaiPerbandinganAlternatif'] as $key => $item)
        <br>
        <p>{{ $numb }}. Membandingkan alternatif berdasarkan kriteria {{ $processAhp['kriteria'][$key]->nama_kriteria }}  dan mencari nilai total masing-masing kolom</p>
        <div class="table-container" style="overflow-x: scroll">
            <table class="table table-bordered text-center">
                <thead>
                    <th>{{ $processAhp['kriteria'][$key]->nama_kriteria }}</th>
                    @foreach($processAhp['mahasiswa'] as $mahasiswa)
                    <th>{{ $mahasiswa->nama_mahasiswa }}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($item as $row)
                    <tr>
                        <th>{{ $processAhp['mahasiswa'][$loop->index]->nama_mahasiswa }}</th>
                        @foreach($row as $column)
                        <td>{{ $column }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Jumlah</th>
                        @foreach($processAhp['sumNilaiPerbandinganAlternatif'][$key] as $item)
                        <td class="font-weight-bold">{{ $item }}</td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>

        <p>{{ $numb }}.1. Sintesis Nilai Perbandingan Alternatif terhadapat kriteria {{ $processAhp['kriteria'][$key]->nama_kriteria }}</p>
        <p>// nilai eigen = masing2 nilai perbandingan / masing2 jumlah kolom nilai perbandingan kriteria </p>

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <th>{{ $processAhp['kriteria'][$key]->nama_kriteria }}</th>
                    @foreach($processAhp['mahasiswa'] as $mahasiswa)
                    <th>{{ $mahasiswa->nama_mahasiswa }}</th>
                    @endforeach
                    <th>Jumlah</th>
                    <th>Rata-rata</th>
                </thead>
                <tbody>
                    @foreach($processAhp['nilaiEigenPerbandinganAlternatif'][$key] as $row)
                    <tr>
                        <th>{{ $processAhp['mahasiswa'][$loop->index]->nama_mahasiswa }}</th>
                        @foreach($row as $column)
                        <td>{{ $column }}</td>
                        @endforeach
                        <th>{{ $processAhp['sumAvgNilaiEigenBarisPerbandinganAlternatif'][$key][$loop->index]['sum'] }}</th>
                        <th>{{ $processAhp['sumAvgNilaiEigenBarisPerbandinganAlternatif'][$key][$loop->index]['avg'] }}</th>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="{{ count($processAhp['mahasiswa']) + 2 }}">Jumlah</th>
                        <td class="font-weight-bold">{{ $processAhp['totalAvgNilaiEigenBarisPerbandinganAlternatif'][$key] }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <p>{{ $numb++ }}.2. Menghitung Nilai CI(Consistency Index) dan CR(Consistency Ratio)</p>
        <p>// λ (lamda)maks = (jumlah kolom alternatif1 x rata_rata baris alternatif1)+(jumlah kolom alternatif2 x rata_rata baris alternatif2)+ ⋯ n.</p>
        <p>λ (lamda)maks = {{ $processAhp['lamdaMaksAlternatif'][$key] }}</p>
        <br>
        <p>// CI = (λ (lamda) maks - n) / (n-1)</p>
        <p>// n = {{ count($processAhp['mahasiswa']) }} (jumlah alternatif)</p>
        <p>CI =({{ $processAhp['lamdaMaksAlternatif'][$key] }} - {{ count($processAhp['mahasiswa']) }}) / ({{ count($processAhp['mahasiswa']) }} - 1) = {{ $processAhp['CI_Alternatif'][$key] }}</p>

        <p>// CR = CI / IR</p>
        <p>IR = {{ $processAhp['IR_Alternatif'] }} (Lihat di tabel nilai Index Ratio)</p>
        <p>CR = {{ $processAhp['CI_Alternatif'][$key] }} / {{ $processAhp['IR_Alternatif'] }} = {{ $processAhp['CR_Alternatif'][$key] }} ({{ ($processAhp['CR_Alternatif'][$key] <= 0.1)? 'konsisten < 0.1':'Tidak Konsisten > 0.1' }})</p> 

        @endforeach

        <br>
        <p>{{ $numb }}. Mencari preferensi, sebagai acuan dalam menentukan peringkat</p>
        <p>//(rata_rata kriteria1 x rata_rata kriteria1_mahasiswa1)+
            (rata_rata kriteria2 x rata_rata kriteria2_mahasiswa1)+
            (rata_rata kriteria3 x rata_rata kriteria3_mahasiswa1) + ... n
        </p>

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
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
                </tbody>
            </table>
        </div>
        <br>

        <h1 class="h4 mb-0 text-gray-800"># Metode TOPSIS</h1>

        <p>1. Ambil Data Bobot Masing-masing Kriteria</p>

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                    <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['kriteriaTopsis'] as $row)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kriteria->nama_kriteria }}</td>
                    <td>{{ $row->bobot_id }} ({{ ucwords($row->bobot->bobot) }})</td>
                    <td>{{ ucwords($row->keterangan) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <p>2. Ambil Data Nilai Alternatif Masing-masing Kriteria</p>

        @php dump($processTopsis['nilaiMahasiswa']) @endphp
        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                    <th>X</th>
                    @foreach($processTopsis['kriteriaTopsis'] as $row)
                    <th>{{ $row->kriteria->nama_kriteria }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['nilaiMahasiswa'] as $row)
                    <tr>
                    <th>{{ $processTopsis['mahasiswa'][$loop->index]->nama_mahasiswa }}</th>
                    @foreach($row as $column)
                    <td>{{ $column }}</td>
                    @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <br>
        <p>3. Nilai mahasiswa dinormalisasi (Euclidean length of a vector)</p>
        @php dump($processTopsis['nilaiNormalisasiMahasiswa']) @endphp
        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                    <th>X</th>
                    @foreach($processTopsis['kriteriaTopsis'] as $row)
                    <th>{{ $row->kriteria->nama_kriteria }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['nilaiNormalisasiMahasiswa'] as $row)
                    <tr>
                    <th>{{ $processTopsis['mahasiswa'][$loop->index]->nama_mahasiswa }}</th>
                    @foreach($row as $column)
                    <td>{{ $column }}</td>
                    @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>

        <p>4. Nilai normalisasi mahasiswa dikali bobot masing-masing kriteria</p>
        @php dump($processTopsis['nilaiNormalisasiMahasiswaTerbobot']) @endphp
        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                    <th>X</th>
                    @foreach($processTopsis['kriteriaTopsis'] as $row)
                    <th>{{ $row->kriteria->nama_kriteria }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['nilaiNormalisasiMahasiswaTerbobot'] as $row)
                    <tr>
                    <th>{{ $processTopsis['mahasiswa'][$loop->index]->nama_mahasiswa }}</th>
                    @foreach($row as $column)
                    <td>{{ $column['nilai'] }}</td>
                    @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>

        <p>5. Mencari Nilai Solusi ideal posistif dan solusi ideal negatif</p>
        <p>// jika kriteria benefit solusi ideal positif (maks) nilai tertingi dan sebaliknya jika cost.</p>
        @php dump($processTopsis['nilaiSolusiIdeal']) @endphp

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Min</th>
                        <th>Maks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['nilaiSolusiIdeal'] as $row)
                    <tr>
                        <td>{{ $processTopsis['kriteria'][$loop->index]->nama_kriteria }}</td>
                        <td>{{ $row['min'] }}</td>
                        <td>{{ $row['maks'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <p>6. Mencari D+ dan D- untuk setiap alternatif</p>
        @php dump($processTopsis['nilai_dplus_dminus']); @endphp

        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>D+</th>
                        <th>D-</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processTopsis['nilai_dplus_dminus'] as $row)
                    <tr>
                        <td>{{ $processTopsis['mahasiswa'][$loop->index]->nama_mahasiswa }}</td>
                        <td>{{ $row['D+'] }}</td>
                        <td>{{ $row['D-'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p>7. Mencari preferensi, sebagai acuan dalam menentukan peringkat</p>
        <p>//Alternatif1 = D- / (D- + D+)</p>


        <div class="table-container" style="overflow-x: scroll">

            <table class="table table-bordered text-center" >
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
                </tbody>
            </table>
        </div>
        <br>

    <div class="text-center">
        <a href="{{ url('/generate/result') }}" class="btn btn-primary mb-3">Menuju Halaman Hasil Generate</a>
    </div>

    </div>
    <!-- /.container-fluid -->

@endsection