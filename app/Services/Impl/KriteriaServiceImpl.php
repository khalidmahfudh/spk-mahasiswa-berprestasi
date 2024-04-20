<?php

namespace App\Services\Impl;

use App\Services\KriteriaService;
use App\Http\Requests\KriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\NilaiKriteriaMahasiswa;
use App\Models\KriteriaTopsis;
use App\Models\KriteriaAHP;


class KriteriaServiceImpl implements KriteriaService

{
    function storeKriteria(KriteriaRequest $request): bool
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Tambahkan kriteria baru
            $kriteria = Kriteria::create($request->all());

            // Dapatkan ID kriteria yang baru ditambahkan dan ambil min nilai dari kriteria
            $kriteriaId = $kriteria->id;
            $kriteriaMinNilai = $kriteria->min_nilai;

            // Dapatkan semua mahasiswa
            $mahasiswa = Mahasiswa::all();
            
            // Tambahkan nilai default untuk setiap mahasiswa
            foreach ($mahasiswa as $mhs) {
                NilaiKriteriaMahasiswa::create([
                    'mahasiswa_id' => $mhs->id,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $kriteriaMinNilai
                ]);
            }

            // Tambahakan Kriteria Pada Metode Topsis dan set nilai default
            KriteriaTopsis::create([
                'kriteria_id' => $kriteriaId,
                'bobot_id' => 5,
                'keterangan' => 'benefit'
            ]);

            $kriteriaAHP = KriteriaAHP::all();

            $uniqueNumbers = [];

            // Mendapatkan angka-angka unik yang ada dalam $existingNumbers
            foreach ($kriteriaAHP as $item) {
                if (!in_array($item->kriteria_id_sumbu_x, $uniqueNumbers)) {
                    $uniqueNumbers[] = $item->kriteria_id_sumbu_x;
                }
                if (!in_array($item->kriteria_id_sumbu_y, $uniqueNumbers)) {
                    $uniqueNumbers[] = $item->kriteria_id_sumbu_y;
                }
            }

            // Menambahkan angka baru ke dalam $uniqueNumbers
            $uniqueNumbers[] = $kriteriaId;

            // Mengurutkan $uniqueNumbers
            sort($uniqueNumbers);

            // Membuat daftar angka yang mungkin
            $possibleNumbers = range(1, max($uniqueNumbers));

            // Mencari angka-angka yang hilang
            $missingNumbers = array_diff($possibleNumbers, $uniqueNumbers);

             // Menambahkan angka baru ke dalam $existingNumbers sesuai dengan pola yang sesuai
            foreach ($possibleNumbers as $x) {
                if (in_array($x, $missingNumbers)) {
                    continue;
                }
                foreach ($possibleNumbers as $y) {
                    if (in_array($y, $missingNumbers)) {
                        continue;
                    }

                    $row = KriteriaAHP::where('kriteria_id_sumbu_x', $x)->where('kriteria_id_sumbu_y', $y)->first();

                    if ($row == null) {
                        KriteriaAHP::create([
                            'kriteria_id_sumbu_x' => $x,
                            'kriteria_id_sumbu_y' => $y,
                            'nilai' => 1,
                        ]);
                    }
                    
                }
            }

            // $existingNumbers = [
            //     [1, 1],
            //     [1, 2],
            //     [1, 4],
            //     [2, 1],
            //     [2, 2],
            //     [2, 4],
            //     [4, 1],
            //     [4, 2],
            //     [4, 4],
            // ];

            // $newNumber = 8; // Angka yang akan ditambahkan

            // $uniqueNumbers = [];

            // // Mendapatkan angka-angka unik yang ada dalam $existingNumbers
            // foreach ($existingNumbers as $combination) {
            //     foreach ($combination as $number) {
            //         if (!in_array($number, $uniqueNumbers)) {
            //             $uniqueNumbers[] = $number;
            //         }
            //     }
            // }

            // // Menambahkan angka baru ke dalam $uniqueNumbers
            // $uniqueNumbers[] = $newNumber;

            // // Mengurutkan $uniqueNumbers
            // sort($uniqueNumbers);

            // // Membuat daftar angka yang mungkin
            // $possibleNumbers = range(1, max($uniqueNumbers));

            // // Mencari angka-angka yang hilang
            // $missingNumbers = array_diff($possibleNumbers, $uniqueNumbers);

            // // Menambahkan angka baru ke dalam $existingNumbers sesuai dengan pola yang sesuai
            // foreach ($possibleNumbers as $i) {
            //     if (in_array($i, $missingNumbers)) {
            //         continue;
            //     }
            //     foreach ($possibleNumbers as $j) {
            //         if (in_array($j, $missingNumbers)) {
            //             continue;
            //         }
            //         $newItem = [$i, $j];

            //         // Periksa apakah elemen baru sudah ada dalam $existingNumbers
            //         if (!in_array($newItem, $existingNumbers)) {
            //             $existingNumbers[] = $newItem;
            //         }
            //     }
            // }

            // // Cetak hasil
            // foreach ($existingNumbers as $combination) {
            //     echo "[" . implode(", ", $combination) . "]\n";
            // }
            

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            dd($e->getMessage());

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }
    }

    function updateKriteria(KriteriaRequest $request): bool
    {
         // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Ambil id, min_nilai, dan max_nilai kriteria
            $idKriteria = $request->id;
            $minNilaiKriteria = $request->min_nilai;
            $maxNilaiKriteria = $request->min_nilai;

            // Temukan Kriteria yang akan diupdate
            $kriteria = Kriteria::findOrFail($idKriteria);

            // Update atribut Kriteria
            $kriteria->update($request->all());

            // Ambil seluruh nilai kriteria mahasiswa berdasarkan id kriteria yang sedang di update
            $nilaiMahasiswa = NilaiKriteriaMahasiswa::where('kriteria_id', $idKriteria)->get();

            // Looping $nilaiMahasiswa dan cek jika nilai kriteria pada mahasiswa masih didalam min dan max nilai kriteria, jika tidak maka update nilai kriteria pada mahasiswa menjadi min_nilai
            foreach ($nilaiMahasiswa as $item) {
                if($item->nilai < $minNilaiKriteria || $item > $maxNilaiKriteria) {
                    // Update nilai kriteria pada mahasiswa menjadi min_nilai
                    $item->update(['nilai' => $minNilaiKriteria]);
                }
            }

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }

    }

    function destroyKriteria(Request $request): bool
    {
        DB::beginTransaction();

        try {
            // Ambil id Kriteria
            $idKriteria = $request->id;

            // Hapus Kriteria berdasarkan id kriteria
            $kriteria = Kriteria::findOrFail($idKriteria);
            $kriteria->delete();

            // Commit transaksi jika penghapusan berhasil
            DB::commit();

            // Mengembalikan true jika berhasil
            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            dd($e->getMessage());

            // Mengembalikan false jika gagal
            return false;
        }
    }

    function updateTopsis(Request $request): bool
    {
         // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Ambil id bobot kriteria topsis
            $idKriteriaTopsis = $request->id;

            // Temukan Kriteria Topsis yang akan diupdate
            $kriteriaTopsis = KriteriaTopsis::findOrFail($idKriteriaTopsis);

            // Update atribut Kriteria Topsis
            $kriteriaTopsis->update([
                'bobot_id' => $request->bobot,
                'keterangan' => $request->keterangan
            ]);

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            dd($e->getMessage());

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }

    }

    public function getFilteredKriteriaAHP():Collection
    {
        // Mengambil data tertentu dari tabel KriteriaAHP yang akan diolah
        $data = KriteriaAHP::select('kriteria_id_sumbu_x', 'kriteria_id_sumbu_y', 'nilai')->get();
        $filteredData = [];

        // Iterasi melalui data untuk melakukan pemfilteran
        foreach ($data as $item) {
            $pair = [$item->kriteria_id_sumbu_x, $item->kriteria_id_sumbu_y];
            $reversePair = [$pair[1], $pair[0]]; // Membuat pasangan "reverse"

            // Memeriksa apakah pasangan atau reverse pasangan belum diproses dan keduanya tidak sama-sama
            if (!in_array($pair, $filteredData) && !in_array($reversePair, $filteredData) && $pair[0] !== $pair[1]) {
                $filteredData[] = $pair;
            }
        }

        // Inisialisasi koleksi untuk menyimpan model KriteriaAHP yang sesuai dengan data dalam $filteredData
        $filteredDataCollection = collect();

        // Iterasi melalui data yang telah difilter dan mengambil data KriteriaAHP yang sesuai
        foreach ($filteredData as $pair) {
            $kriteriaAHP = KriteriaAHP::where('kriteria_id_sumbu_x', $pair[0])
                ->where('kriteria_id_sumbu_y', $pair[1])
                ->with('kriteria_x', 'kriteria_y') // Menggunakan Eager Loading untuk mengambil data Kriteria
                ->first();

            // Jika data KriteriaAHP yang sesuai ditemukan, maka dimasukkan ke dalam koleksi filteredDataCollection
            if ($kriteriaAHP) {
                $filteredDataCollection->push($kriteriaAHP);
            }
        }

        return $filteredDataCollection;
    }

    function updateAHP(Request $request): bool
    {

         // Mulai transaksi database
        DB::beginTransaction();

        try {
            $requestData = request()->except(['_method', '_token']);
            $updateData = [];
            
            foreach ($requestData as $data) {
                $parts = explode("_", $data);
                $kriteria_id_x = $parts[0];
                $kriteria_id_y = $parts[1];
                $nilai_perbandingan_temp = $parts[2];
                $nilai_perbandingan = ($nilai_perbandingan_temp >= 1) ? $nilai_perbandingan_temp : (1 / abs($nilai_perbandingan_temp));
            
                // Tambahkan data yang akan diupdate ke dalam array
                $updateData[] = [
                    'kriteria_id_x' => $kriteria_id_x,
                    'kriteria_id_y' => $kriteria_id_y,
                    'nilai_perbandingan' => $nilai_perbandingan,
                ];
            }
            
            foreach ($updateData as $item) {
                // Update nilai sesuai kondisi WHERE (kriteria_id_x, kriteria_id_y)
                KriteriaAHP::where('kriteria_id_sumbu_x', $item['kriteria_id_x'])
                    ->where('kriteria_id_sumbu_y', $item['kriteria_id_y'])
                    ->update(['nilai' => $item['nilai_perbandingan']]);
        
                // Reverse: (kriteria_id_y, kriteria_id_x)
                KriteriaAHP::where('kriteria_id_sumbu_x', $item['kriteria_id_y'])
                    ->where('kriteria_id_sumbu_y', $item['kriteria_id_x'])
                    ->update(['nilai' => (1 / $item['nilai_perbandingan'])]);
            }

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan dan tampilkan pesan kesalahan
            dd($e->getMessage());

            // Tangani kesalahan dan kembalikan false untuk indikasi gagal
            return false;
        }

    }
}