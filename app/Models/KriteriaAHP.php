<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class KriteriaAHP extends Model
{
    protected $table = "kriteria_ahp";
    public $timestamps = false; 

    protected $fillable = [
        'kriteria_id_sumbu_x',
        'kriteria_id_sumbu_y',
        'nilai'
    ];

    public function kriteria_x(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "id", // PK on kriteria table
            "kriteria_id_sumbu_x", // FK on kriteria_ahp table
        );
    }

    public function kriteria_y(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "id", // PK on kriteria table
            "kriteria_id_sumbu_y", // FK on kriteria_ahp table
        );
    }
}
