<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_preferensi_mahasiswa_topsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("mahasiswa_id");
            $table->decimal('preferensi', 8, 6);
            
            $table->foreign("mahasiswa_id")->references("id")->on("mahasiswa");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_preferensi_mahasiswa_topsis');
    }
};
