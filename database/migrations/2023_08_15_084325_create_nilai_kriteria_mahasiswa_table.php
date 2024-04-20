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
        Schema::create('nilai_kriteria_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("mahasiswa_id");
            $table->unsignedBigInteger("kriteria_id");
            $table->double('nilai');

            $table->foreign("mahasiswa_id")->references("id")->on("mahasiswa")->onDelete('cascade');;
            $table->foreign("kriteria_id")->references("id")->on("kriteria")->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nonaktifkan pemeriksaan ketergantungan sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('nilai_kriteria_mahasiswa');

        // Aktifkan kembali pemeriksaan ketergantungan
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
