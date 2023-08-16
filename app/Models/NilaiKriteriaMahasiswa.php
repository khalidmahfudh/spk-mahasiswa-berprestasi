<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiKriteriaMahasiswa extends Model
{
    protected $table = "nilai_kriteria_mahasiswa";

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(
            Mahasiswa::class, 
            "mahasiswa_id", 
            "id"
        );
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(
            Kriteria::class, 
            "kriteria_id", //FK on nilai_kriteria_mahasiswa table
            "id" //PK on kriteria table
        );
    }
}
