<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class KriteriaTopsis extends Model
{
    protected $table = "kriteria_topsis";

    public function kriteria(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "kriteria_id", // FK on kriteria_topsis table
            "id" // PK on kriteria table
        );
    }
}
