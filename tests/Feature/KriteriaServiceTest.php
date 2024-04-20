<?php

namespace Tests\Feature;

use App\Services\KriteriaService;
use Database\Seeders\KriteriaSeeder;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KriteriaRequest;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class KriteriaServiceTest extends TestCase
{
    private KriteriaService $kriteriaService;

    public function setUp(): void
    {
        parent::setUp();
        $this->kriteriaService = $this->app->make(KriteriaService::class);

        // Nonaktifkan constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Lakukan truncate atau delete
        Kriteria::truncate();

        // Aktifkan constraint kembali
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function testTambahKriteriaSuccess()
    {   
        $this->seed([KriteriaSeeder::class]);

        // Buat instance KriteriaRequest dengan data yang diperlukan
        $request = new KriteriaRequest([
            'nama_kriteria' => 'Bahasa Arab',
        ]);

        // Panggil metode store pada KriteriaService
        $result = $this->kriteriaService->store($request);

        // Mengecek apakah $result benar (true) sebagai tanda bahwa penyimpanan berhasil.
        $this->assertTrue($result);
    }

    public function testUbahKriteriaSuccess()
    {   
        $this->seed([KriteriaSeeder::class]);

        // Buat KriteriaRequest baru dengan data perubahan
        $requestUbah = new KriteriaRequest([
            'id' => 1,
            'nama_kriteria' => 'Prestasi Akademik', // Data perubahan
        ]);

        // Panggil metode update pada KriteriaService untuk mengubah data
        $result = $this->kriteriaService->update($requestUbah);

        // Verifikasi (assertion)
        $this->assertTrue($result); // Memastikan perubahan berhasil

    }

    public function testHapusKriteriaSuccess()
    {   
        $this->seed([KriteriaSeeder::class]);

        // Buat KriteriaRequest dengan data yang hendak dihapus
        $requestHapus = new Request([
            'id' => 1 // Id IPK yang hendak dihapus
        ]);

        // Simpan ID dari data kriteria yang telah ditambahkan
        $kriteriaId = $requestHapus->id;

        // Panggil metode destroy pada KriteriaService untuk menghapus data
        $this->kriteriaService->destroy($requestHapus);

        // Verifikasi (assertion)
        // Coba mencari data dengan ID yang sama dalam database
        $kriteriaDeleted = Kriteria::find($kriteriaId);

        // Verifikasi bahwa data tersebut tidak ditemukan
        $this->assertNull($kriteriaDeleted);

    }

}
