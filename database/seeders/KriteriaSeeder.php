<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = new Kriteria();
        $kriteria->id = 1;
        $kriteria->kode_kriteria = "K01";
        $kriteria->nama_kriteria = "IPK";
        $kriteria->bilangan = "pecahan";
        $kriteria->min_nilai = 0.0;
        $kriteria->max_nilai = 4.0;
        $kriteria->save();

        $kriteria = new Kriteria();
        $kriteria->id = 2;
        $kriteria->kode_kriteria = "K02";
        $kriteria->nama_kriteria = "Karya Ilmiah";
        $kriteria->bilangan = "bulat";
        $kriteria->min_nilai = 0;
        $kriteria->max_nilai = 20;
        $kriteria->save();

        $kriteria = new Kriteria();
        $kriteria->id = 3;
        $kriteria->kode_kriteria = "K03";
        $kriteria->nama_kriteria = "Prestasi";
        $kriteria->bilangan = "bulat";
        $kriteria->min_nilai = 0;
        $kriteria->max_nilai = 20;
        $kriteria->save();

        $kriteria = new Kriteria();
        $kriteria->id = 4;
        $kriteria->kode_kriteria = "K04";
        $kriteria->nama_kriteria = "Ekstrakurikuler";
        $kriteria->bilangan = "bulat";
        $kriteria->min_nilai = 0;
        $kriteria->max_nilai = 10;
        $kriteria->save();

        $kriteria = new Kriteria();
        $kriteria->id = 5;
        $kriteria->kode_kriteria = "K05";
        $kriteria->nama_kriteria = "Toefl";
        $kriteria->bilangan = "bulat";
        $kriteria->min_nilai = 310;
        $kriteria->max_nilai = 677;
        $kriteria->save();

    }
}
