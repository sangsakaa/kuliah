<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Sesi_Harian extends Model
{
    use HasFactory;
    protected $table = "daftar_sesi_harian";
    protected $fillable = [
        'sesi_harian_id',
        // other fillable fields...
    ];
}
