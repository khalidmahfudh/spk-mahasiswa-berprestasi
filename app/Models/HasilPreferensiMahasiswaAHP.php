<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class HasilPreferensiMahasiswaAHP extends Model
{
    protected $table = "hasil_preferensi_mahasiswa_ahp";

    public $timestamps = false; 

    protected $fillable = [
        'mahasiswa_id',
        'preferensi'
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(
            Mahasiswa::class, 
            "id", // PK on mahasiswa table
            "mahasiswa_id", // FK on hasil_preferensi_mahasiswa_ahp table
        );
    }
}
