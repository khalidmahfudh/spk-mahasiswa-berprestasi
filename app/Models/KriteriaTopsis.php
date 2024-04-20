<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class KriteriaTopsis extends Model
{
    protected $table = "kriteria_topsis";
    public $timestamps = false; 

    protected $fillable = [
        'kriteria_id',
        'bobot_id',
        'keterangan',
    ];

    public function kriteria(): HasOne
    {
        return $this->hasOne(
            Kriteria::class, 
            "id", // PK on kriteria table
            "kriteria_id" // FK on kriteria_topsis table
        );
    }

    public function bobot(): HasOne
    {
        return $this->hasOne(
            Bobot::class, 
            "id", // PK on bobot table
            "bobot_id" // FK on kriteria_topsis table
        );
    }
}
