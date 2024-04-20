<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IndexRatioAHP;

class IndexRatioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 1;
        $kriteriaTopsis->jumlah_elemen = 1;
        $kriteriaTopsis->nilai = 0;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 2;
        $kriteriaTopsis->jumlah_elemen = 2;
        $kriteriaTopsis->nilai = 0;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 3;
        $kriteriaTopsis->jumlah_elemen = 3;
        $kriteriaTopsis->nilai = 0.58;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 4;
        $kriteriaTopsis->jumlah_elemen = 4;
        $kriteriaTopsis->nilai = 0.9;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 5;
        $kriteriaTopsis->jumlah_elemen = 5;
        $kriteriaTopsis->nilai = 1.12;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 6;
        $kriteriaTopsis->jumlah_elemen = 6;
        $kriteriaTopsis->nilai = 1.24;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 7;
        $kriteriaTopsis->jumlah_elemen = 7;
        $kriteriaTopsis->nilai = 1.32;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 8;
        $kriteriaTopsis->jumlah_elemen = 8;
        $kriteriaTopsis->nilai = 1.41;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 9;
        $kriteriaTopsis->jumlah_elemen = 9;
        $kriteriaTopsis->nilai = 1.45;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 10;
        $kriteriaTopsis->jumlah_elemen = 10;
        $kriteriaTopsis->nilai = 1.49;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 11;
        $kriteriaTopsis->jumlah_elemen = 11;
        $kriteriaTopsis->nilai = 1.51;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 12;
        $kriteriaTopsis->jumlah_elemen = 12;
        $kriteriaTopsis->nilai = 1.54;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 13;
        $kriteriaTopsis->jumlah_elemen = 13;
        $kriteriaTopsis->nilai = 1.56;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 14;
        $kriteriaTopsis->jumlah_elemen = 14;
        $kriteriaTopsis->nilai = 1.57;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 15;
        $kriteriaTopsis->jumlah_elemen = 15;
        $kriteriaTopsis->nilai = 1.59;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 16;
        $kriteriaTopsis->jumlah_elemen = 16;
        $kriteriaTopsis->nilai = 1.61;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 17;
        $kriteriaTopsis->jumlah_elemen = 17;
        $kriteriaTopsis->nilai = 1.65;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 18;
        $kriteriaTopsis->jumlah_elemen = 18;
        $kriteriaTopsis->nilai = 1.69;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 19;
        $kriteriaTopsis->jumlah_elemen = 19;
        $kriteriaTopsis->nilai = 1.73;
        $kriteriaTopsis->save();

        $kriteriaTopsis = new IndexRatioAHP();
        $kriteriaTopsis->id = 20;
        $kriteriaTopsis->jumlah_elemen = 20;
        $kriteriaTopsis->nilai = 1.77;
        $kriteriaTopsis->save();

    }
}
