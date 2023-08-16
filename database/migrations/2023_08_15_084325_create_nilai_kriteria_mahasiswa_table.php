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
        Schema::create('nilai_kriteria_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("mahasiswa_id");
            $table->unsignedBigInteger("kriteria_id");
            $table->double('nilai');

            $table->foreign("mahasiswa_id")->references("id")->on("mahasiswa");
            $table->foreign("kriteria_id")->references("id")->on("kriteria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kriteria_mahasiswa');
    }
};
