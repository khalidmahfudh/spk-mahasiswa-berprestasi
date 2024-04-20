<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Import DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('nim', 9)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nonaktifkan pemeriksaan ketergantungan sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('mahasiswa');

        // Aktifkan kembali pemeriksaan ketergantungan
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
