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
        Schema::create('kriteria_topsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kriteria_id");
            $table->unsignedBigInteger('bobot')->default(1);
            $table->enum('keterangan', ['benefit', 'cost']);
            
            $table->foreign("kriteria_id")->references("id")->on("kriteria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_topsis');
    }
};
