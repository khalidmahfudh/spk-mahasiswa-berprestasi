<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\KriteriaAHP;
use App\Models\Kriteria;
use App\Services\KriteriaService;

class KriteriaAHPController extends Controller
{
    private KriteriaService $kriteriaService;

    /**
     * @param KriteriaService $kriteriaService
     */
    public function __construct(KriteriaService $kriteriaService)
    {
        $this->kriteriaService = $kriteriaService;
    }

    public function index(): Response
    {
        $title = 'Bobot Kriteria AHP';

        $kriteriaAhp = KriteriaAHP::all();

        $kriteria = Kriteria::all();

        return response()->view('managekriteriaahp.index', compact('title', 'kriteriaAhp', 'kriteria'));
    }

    public function edit(): Response
    {
        // Menentukan judul halaman
        $title = 'Bobot Kriteria AHP';

       // Panggil metode dari KriteriaService untuk mendapatkan data yang diperlukan
       $compKriteria = $this->kriteriaService->getFilteredKriteriaAHP();

        // Mengembalikan halaman tampilan dengan data yang diperlukan
        return response()->view('managekriteriaahp.edit', compact('title', 'compKriteria'));

    }

    public function update(Request $request): RedirectResponse
    {
        if ($this->kriteriaService->updateAHP($request)) {
            return redirect()->route('matrixkriteriaahp')->with('success', 'Data Nilai Perbandingan Berhasil Diubah.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Perubahan data gagal. Silahkan coba lagi.');
        }
    }
}
