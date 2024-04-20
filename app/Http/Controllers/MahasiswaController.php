<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\NilaiKriteriaMahasiswa;
use App\Http\Requests\MahasiswaRequest;
use App\Services\MahasiswaService;

class MahasiswaController extends Controller
{
    private MahasiswaService $mahasiswaService;

    /**
     * @param MahasiswaService $mahasiswaService
     */
    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->mahasiswaService = $mahasiswaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        $title = 'Daftar Mahasiswa yang Diuji';

        $kriteria = Kriteria::get();

        $mahasiswa = Mahasiswa::all();
    

        return response()->view('managemahasiswa.index', compact('title','mahasiswa','kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $title = 'Tambah Mahasiswa yang Diuji';

        $kriteria = Kriteria::all();

        return response()->view('managemahasiswa.create', compact('title', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        if ($this->mahasiswaService->store($request)) {
            return redirect()->route('managemahasiswa')->with('success', 'Data Mahasiswa Berhasil Ditambahkan.');
        } else {
            return redirect('/managemahasiswa/create')->withInput()->with('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Ubah Data Mahasiswa';

        $mahasiswa = Mahasiswa::find($id);
        $kriteria = Kriteria::all();
        $nilaiKriteriaMahasiswa = [];

        foreach ($kriteria as $kriteriaItem) {
            array_push(
                $nilaiKriteriaMahasiswa, 
                NilaiKriteriaMahasiswa::where('kriteria_id', $kriteriaItem->id)->where('mahasiswa_id', $id)->first()
            );
        }

        return response()->view('managemahasiswa.edit', compact('title','mahasiswa', 'kriteria', 'nilaiKriteriaMahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request)
    {
        if ($this->mahasiswaService->update($request)) {
            return redirect()->route('managemahasiswa')->with('success', 'Data Mahasiswa Berhasil Diubah.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Perubahan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->mahasiswaService->destroy($request);

        if ($result) {
            return redirect()->route('managemahasiswa')->with('success', 'Data Mahasiswa Berhasil Dihapus.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Penghapus data gagal. Silahkan coba lagi.');
        }
    }
}
