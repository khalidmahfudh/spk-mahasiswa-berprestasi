<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $table = "bobot";
    public $timestamps = false; 

    protected $fillable = [
        'bobot'
    ];

    public function kriteria_topsis(): BelongsTo
    {
        return $this->belongsTo(
            KriteriaTopsis::class, 
            "bobot_id", // FK on kriteria_topsis table
            "id" // PK on bobot table
        );
    }
}
