<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class KriteriaAHP extends Model
{
    protected $table = "kriteria_ahp";

    public function kriteria_x(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "kriteria_id_sumbu_x", // FK on kriteria_ahp table
            "id" // PK on kriteria table
        );
    }

    public function kriteria_y(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "kriteria_id_sumbu_y", // FK on kriteria_ahp table
            "id" // PK on kriteria table
        );
    }
}
