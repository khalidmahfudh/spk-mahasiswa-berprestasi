<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bobot;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bobot = new Bobot();
        $bobot->id = 1;
        $bobot->bobot = "tidak penting";
        $bobot->save();

        $bobot = new Bobot();
        $bobot->id = 2;
        $bobot->bobot = "kurang penting";
        $bobot->save();

        $bobot = new Bobot();
        $bobot->id = 3;
        $bobot->bobot = "cukup penting";
        $bobot->save();

        $bobot = new Bobot();
        $bobot->id = 4;
        $bobot->bobot = "penting";
        $bobot->save();

        $bobot = new Bobot();
        $bobot->id = 5;
        $bobot->bobot = "sangat penting";
        $bobot->save();
    }
}
