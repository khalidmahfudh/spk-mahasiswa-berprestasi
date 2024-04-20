<?php

namespace App\Http\Controllers;

use App\Models\HasilPreferensiMahasiswaAHP;
use App\Models\HasilPreferensiMahasiswaTopsis;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\KriteriaAHP;
use App\Models\KriteriaTopsis;
use App\Services\GenerateService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class GenerateController extends Controller
{
    private GenerateService $generateService;

    /**
     * @param GenerateService $generateService
     */
    public function __construct(GenerateService $generateService)
    {
        $this->generateService = $generateService;
    }

    public function index (): Response
    {
        $title = 'Generate Peringkat Mahasiswa';

        $mahasiswa = Mahasiswa::all();

        $kriteria = Kriteria::all();

        $kriteriaAhp = KriteriaAHP::all();

        $kriteriaTopsis = KriteriaTopsis::all();

        return response()->view('generate.index', compact('title', 'mahasiswa', 'kriteria', 'kriteriaAhp', 'kriteriaTopsis'));
    }

    public function process(Request $request): RedirectResponse|Response
    {
        $showProcess = $request->showProcess;
        
        // METODE TOPSIS
        $processTopsis = $this->generateService->processTopsis();

        // METODE AHP
        $processAhp = $this->generateService->processAhp();

        if ($showProcess) {
            $title = 'Proses Generate Peringkat Mahasiswa';

            $preferensiAhp = HasilPreferensiMahasiswaAHP::with('mahasiswa')->get();

            $preferensiTopsis = HasilPreferensiMahasiswaTopsis::with('mahasiswa')->get();

            return response()->view('generate.process', compact('title', 'processTopsis', 'processAhp', 'preferensiTopsis', 'preferensiAhp'));
        }
        
        return redirect()->route('result');
    } 

    public function result()
    {
        $title = [
            'main' => 'Hasil Generate Peringkat Mahasiswa',
            'ahp' => 'Hasil Generate Peringkat Mahasiswa Metode AHP',
            'topsis' => 'Hasil Generate Peringkat Mahasiswa Metode TOPSIS'
        ];

        $preferensiAhp = HasilPreferensiMahasiswaAHP::with('mahasiswa')->get();

        $preferensiTopsis = HasilPreferensiMahasiswaTopsis::with('mahasiswa')->get();
    
        return response()->view('generate.result', compact('title', 'preferensiAhp', 'preferensiTopsis'));
    }

}
