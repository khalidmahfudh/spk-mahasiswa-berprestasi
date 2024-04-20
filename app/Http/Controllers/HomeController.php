<?php

namespace App\Http\Controllers;

use App\Models\HasilPreferensiMahasiswaAHP;
use App\Models\HasilPreferensiMahasiswaTopsis;
use Illuminate\Http\Response;
use App\Models\Kriteria;
use App\Models\Mahasiswa;

class HomeController extends Controller
{
    public function index (): Response
    {
        $title = 'Homepage';

        $kriteria = Kriteria::all();
        $mahasiswa = Mahasiswa::all();

        return response()->view("home", compact('title', 'kriteria', 'mahasiswa',));
    }

}
