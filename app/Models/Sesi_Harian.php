<?php

namespace App\Models;

use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sesi_Harian extends Model
{
    use HasFactory;
    protected $table = "sesi_harian";

    public function Kelompok()
    {
        return $this->hasMany(Daftar_Sesi_Harian::class, 'sesi_harian_id',);
    }
}
