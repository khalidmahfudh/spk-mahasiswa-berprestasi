<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexRatioAHP extends Model
{
    protected $table = "index_ratio_ahp";
    public $timestamps = false; 

    protected $fillable = [
        'jumlah_elemen',
        'nilai'
    ];
}
