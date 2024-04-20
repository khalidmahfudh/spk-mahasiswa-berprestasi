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
        Schema::create('kriteria_ahp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kriteria_id_sumbu_x");
            $table->unsignedBigInteger("kriteria_id_sumbu_y");
            $table->double('nilai');
            
            $table->foreign("kriteria_id_sumbu_x")->references("id")->on("kriteria")->onDelete('cascade');
            $table->foreign("kriteria_id_sumbu_y")->references("id")->on("kriteria")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nonaktifkan pemeriksaan ketergantungan sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::dropIfExists('kriteria_ahp');

        // Aktifkan kembali pemeriksaan ketergantungan
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
