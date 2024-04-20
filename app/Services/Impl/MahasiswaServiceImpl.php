<?php

namespace App\Services\Impl;

use App\Services\MahasiswaService;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\NilaiKriteriaMahasiswa;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaServiceImpl implements MahasiswaService

{
    function store(MahasiswaRequest $request): bool
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Tambahkan mahasiswa baru
            $mahasiswa = Mahasiswa::create(
                [
                    'nama_mahasiswa' => $request->nama_mahasiswa,
                    'nim' => $request->nim
                ]
            );

            // Dapatkan ID mahasiswa yang baru ditambahkan
            $mahasiswaId = $mahasiswa->id;

            // Ambil Isi Kriteria
            $allKriteria = Kriteria::all();

            // Lakukan Loopping pada Kriteria dan Tambahkan nilai masing-masing kriteria penilaian mahasiswa
            foreach ($allKriteria as $kriteria) {
                $nilaiKriteria = $request->input('kriteria_' . $kriteria->id);
                NilaiKriteriaMahasiswa::create([
                    'mahasiswa_id' => $mahasiswaId,
                    'kriteria_id' => $kriteria->id,
                    'nilai' => $nilaiKriteria
                ]);
            }

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            // dd($e->getMessage());

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }
    }

    function update(MahasiswaRequest $request): bool
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Ambil id mahasiswa
            $mahasiswaId = $request->id;

            // Temukan Mahasiswa yang akan diupdate
            $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

            // Update atribut Kriteria
            $mahasiswa->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'nim' => $request->nim
            ]);

            // Ambil Isi Kriteria
            $allKriteria = Kriteria::all();

            // Lakukan Loopping pada Kriteria dan Update nilai masing-masing kriteria penilaian mahasiswa
            foreach ($allKriteria as $kriteria) {

                $nilaiKriteriaReq = $request->input('kriteria_' . $kriteria->id);

                 // Temukan Mahasiswa yang akan diupdate bredasarkan kriteria tertentu
                $nilaiKriteria = NilaiKriteriaMahasiswa::where('mahasiswa_id',$mahasiswaId)->where('kriteria_id', $kriteria->id)->first();

                // Update Nilai mahasiswa pada kriteria tertentu
                $nilaiKriteria->update([
                    'nilai' => $nilaiKriteriaReq
                ]);

            }

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            // dd($e->getMessage());

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }
    }

    function destroy(Request $request): bool
    {
        DB::beginTransaction();

        try {
            // Ambil id Mahasiswa
            $mahasiswaId = $request->id;

            // Hapus nilai kriteria mahasiswa yang terkait
            NilaiKriteriaMahasiswa::where('mahasiswa_id', $mahasiswaId)->delete();

            // Hapus Mahasiswa berdasarkan id mahasiswa
            $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
            $mahasiswa->delete();

            // Commit transaksi jika penghapusan berhasil
            DB::commit();

            // Mengembalikan true jika berhasil
            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            // dd($e->getMessage());

            // Mengembalikan false jika gagal
            return false;
        }
    }
}