<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KriteriaTopsis;

class KriteriaTopsisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaTopsis = new KriteriaTopsis();
        $kriteriaTopsis->id = 1;
        $kriteriaTopsis->kriteria_id = 1;
        $kriteriaTopsis->bobot_id = 5;
        $kriteriaTopsis->keterangan = 'benefit';
        $kriteriaTopsis->save();

        $kriteriaTopsis = new KriteriaTopsis();
        $kriteriaTopsis->id = 2;
        $kriteriaTopsis->kriteria_id = 2;
        $kriteriaTopsis->bobot_id = 5;
        $kriteriaTopsis->keterangan = 'benefit';
        $kriteriaTopsis->save();

        $kriteriaTopsis = new KriteriaTopsis();
        $kriteriaTopsis->id = 3;
        $kriteriaTopsis->kriteria_id = 3;
        $kriteriaTopsis->bobot_id = 5;
        $kriteriaTopsis->keterangan = 'benefit';
        $kriteriaTopsis->save();

        $kriteriaTopsis = new KriteriaTopsis();
        $kriteriaTopsis->id = 4;
        $kriteriaTopsis->kriteria_id = 4;
        $kriteriaTopsis->bobot_id = 5;
        $kriteriaTopsis->keterangan = 'benefit';
        $kriteriaTopsis->save();

        $kriteriaTopsis = new KriteriaTopsis();
        $kriteriaTopsis->id = 5;
        $kriteriaTopsis->kriteria_id = 5;
        $kriteriaTopsis->bobot_id = 5;
        $kriteriaTopsis->keterangan = 'benefit';
        $kriteriaTopsis->save();
    }
}
