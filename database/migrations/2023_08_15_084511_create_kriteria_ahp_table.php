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
        Schema::create('kriteria_ahp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kriteria_id_sumbu_x");
            $table->unsignedBigInteger("kriteria_id_sumbu_y");
            $table->double('nilai');
            
            $table->foreign("kriteria_id_sumbu_x")->references("id")->on("kriteria");
            $table->foreign("kriteria_id_sumbu_y")->references("id")->on("kriteria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_ahp');
    }
};
