<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_mahasiswa',
        'nim',
    ];

    public function nilai_kriteria_mahasiswa(): HasMany
    {
        return $this->hasMany(
            NilaiKriteriaMahasiswa::class, 
            "mahasiswa_id", // FK on nilai_kriteria_mahasiswa table
            "id" // PK on mahasiswa table
        );
    }

    public function hasil_preferensi_mahasiswa_ahp(): BelongsTo
    {
        return $this->belongsTo(
            HasilPreferensiMahasiswaAHP::class, 
            "mahasiswa_id", // FK on hasil_preferensi_mahasiswa_ahp table
            "id" // PK on mahasiswa table
        );
    }

    public function hasil_preferensi_mahasiswa_topsis(): BelongsTo
    {
        return $this->belongsTo(
            HasilPreferensiMahasiswaTopsis::class, 
            "mahasiswa_id", // FK on hasil_preferensi_mahasiswa_topsis table
            "id" // PK on mahasiswa table
        );
    }
}
