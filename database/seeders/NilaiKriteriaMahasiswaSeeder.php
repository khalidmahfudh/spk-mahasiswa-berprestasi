<?php

namespace Database\Seeders;

use App\Models\NilaiKriteriaMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiKriteriaMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nilai_kriteria_mahasiswa = new NilaiKriteriaMahasiswa();
        $nilai_kriteria_mahasiswa->id = 1;
        $nilai_kriteria_mahasiswa->mahasiswa_id = 1;
        $nilai_kriteria_mahasiswa->kriteria_id = 1;
        $nilai_kriteria_mahasiswa->nilai = 3.05;
        $nilai_kriteria_mahasiswa->save();

        $nilai_kriteria_mahasiswa = new NilaiKriteriaMahasiswa();
        $nilai_kriteria_mahasiswa->id = 2;
        $nilai_kriteria_mahasiswa->mahasiswa_id = 1;
        $nilai_kriteria_mahasiswa->kriteria_id = 2;
        $nilai_kriteria_mahasiswa->nilai = 9;
        $nilai_kriteria_mahasiswa->save();

        $nilai_kriteria_mahasiswa = new NilaiKriteriaMahasiswa();
        $nilai_kriteria_mahasiswa->id = 3;
        $nilai_kriteria_mahasiswa->mahasiswa_id = 1;
        $nilai_kriteria_mahasiswa->kriteria_id = 3;
        $nilai_kriteria_mahasiswa->nilai = 7;
        $nilai_kriteria_mahasiswa->save();

        $nilai_kriteria_mahasiswa = new NilaiKriteriaMahasiswa();
        $nilai_kriteria_mahasiswa->id = 4;
        $nilai_kriteria_mahasiswa->mahasiswa_id = 1;
        $nilai_kriteria_mahasiswa->kriteria_id = 4;
        $nilai_kriteria_mahasiswa->nilai = 3;
        $nilai_kriteria_mahasiswa->save();

        $nilai_kriteria_mahasiswa = new NilaiKriteriaMahasiswa();
        $nilai_kriteria_mahasiswa->id = 5;
        $nilai_kriteria_mahasiswa->mahasiswa_id = 1;
        $nilai_kriteria_mahasiswa->kriteria_id = 5;
        $nilai_kriteria_mahasiswa->nilai = 400;
        $nilai_kriteria_mahasiswa->save();
    }
}
