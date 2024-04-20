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
        Schema::create('kriteria_topsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kriteria_id");
            $table->unsignedBigInteger("bobot_id");
            $table->enum('keterangan', ['benefit', 'cost']);
            
            $table->foreign("kriteria_id")->references("id")->on("kriteria")->onDelete('cascade');
            $table->foreign("bobot_id")->references("id")->on("bobot")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nonaktifkan pemeriksaan ketergantungan sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::dropIfExists('kriteria_topsis');

        // Aktifkan kembali pemeriksaan ketergantungan
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
