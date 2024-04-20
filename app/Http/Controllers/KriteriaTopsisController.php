<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\KriteriaTopsis;
use App\Models\Bobot;
use App\Services\KriteriaService;

class KriteriaTopsisController extends Controller
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
        $title = 'Bobot Kriteria Topsis';

        $kriteriaTopsis = KriteriaTopsis::all();
        $bobot = Bobot::all();

        return response()->view('managekriteriatopsis.index', compact('title','kriteriaTopsis', 'bobot'));
    }


    public function update(Request $request): RedirectResponse
    {
        if ($this->kriteriaService->updateTopsis($request)) {
            return redirect()->route('bobotkriteriatopsis')->with('success', 'Data Bobot Kriteria Topsis Berhasil Diubah.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Perubahan data gagal. Silahkan coba lagi.');
        }
    }
    
}

