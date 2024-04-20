<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Kriteria;
use App\Http\Requests\KriteriaRequest;
use App\Services\KriteriaService;
use Illuminate\Support\Facades\DB; 

class KriteriaController extends Controller
{
    private KriteriaService $kriteriaService;

    /**
     * @param KriteriaService $kriteriaService
     */
    public function __construct(KriteriaService $kriteriaService)
    {
        $this->kriteriaService = $kriteriaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        $title = 'Daftar Kriteria Penilaian';

        $kriteria = Kriteria::orderBy('kode_kriteria')->get();

        return response()->view('managekriteria.index', compact('title','kriteria'));
    }

    /**
     * Get an array of available 'Kode Kriteria' for creating a new Kriteria or updating a Kriteria.
     *
     * @return array
     */
    private function getAvailableKodes(): array
    {
        // Mengambil daftar kode kriteria yang sudah ada dalam database
        $existingKodes = DB::table('kriteria')->pluck('kode_kriteria')->toArray();

        // Melakukan pengurutan kode tertinggi berada diakhir array
        sort($existingKodes);

        // Mengambil kode terakhir dan mengonversi angka di dalamnya menjadi integer
        $lastKode = end($existingKodes);
        $lastKodeIntoInt = intval(substr($lastKode, 1));

        // Menyimpan kode-kode yang tersedia dalam array
        $availableKodes = [];
        for ($i = 1; $i <= $lastKodeIntoInt + 1; $i++) {
            // Membuat kode dengan format 'K01', 'K02', dll.
            $kode = 'K' . str_pad($i, 2, '0', STR_PAD_LEFT);
            
            // Memeriksa apakah kode sudah ada dalam database
            if (!in_array($kode, $existingKodes)) {
                // Menambahkan kode yang tersedia ke dalam array
                $availableKodes[] = $kode;
            }
        }

        return $availableKodes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $title = 'Buat Kriteria Penilaian Baru';

        $availableKodes = $this->getAvailableKodes();

        return response()->view('managekriteria.create', compact('title', 'availableKodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KriteriaRequest $request): RedirectResponse
    {
        if ($this->kriteriaService->storeKriteria($request)) {
            return redirect()->route('managekriteria')->with('success', 'Data Kriteria Berhasil Ditambahkan.');
        } else {
            return redirect('/managekriteria/create')->withInput()->with('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $title = 'Ubah Kriteria Penilaian';

        $kriteria = Kriteria::find($id);

        $availableKodes = $this->getAvailableKodes();


        return response()->view('managekriteria.edit', compact('title','kriteria', 'availableKodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KriteriaRequest $request): RedirectResponse
    {
        if ($this->kriteriaService->updateKriteria($request)) {
            return redirect()->route('managekriteria')->with('success', 'Data Kriteria Berhasil Diubah.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Perubahan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $result = $this->kriteriaService->destroyKriteria($request);

        if ($result) {
            return redirect()->route('managekriteria')->with('success', 'Data Kriteria Berhasil Dihapus.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Penghapus data gagal. Silahkan coba lagi.');
        }
    }
}
