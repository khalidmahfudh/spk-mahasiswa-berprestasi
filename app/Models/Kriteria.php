<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = "kriteria";

    public function nilai_kriteria_mahasiswa(): HasMany
    {
        return $this->hasMany(
            NilaiKriteriaMahasiswa::class, 
            "kriteria_id", // FK on nilai_kriteria_mahasiswa table
            "id" // PK on kriteria table
        );
    }

    public function kriteria_ahp_x(): BelongsTo
    {
        return $this->belongsTo(
            KriteriaAHP::class, 
            "kriteria_id_sumbu_x", // FK on kriteria_ahp table
            "id" // PK on kriteria table
        );
    }

    public function kriteria_ahp_y(): BelongsTo
    {
        return $this->belongsTo(
            KriteriaAHP::class, 
            "kriteria_id_sumbu_y", // FK on kriteria_ahp table
            "id" // PK on kriteria table
        );
    }

    public function kriteria_topsis(): BelongsTo
    {
        return $this->belongsTo(
            KriteriaTopsis::class, 
            "kriteria_id", // FK on kriteria_topsis table
            "id" // PK on kriteria table
        );
    }
}
