<?php

namespace App\Models;

use App\Models\Sesi_Harian;
use App\Models\Anggota_Kelompok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = "kelompok";


    public function JmlMahasiswa()
    {
        return $this->hasMany(Anggota_Kelompok::class, 'kelompok_id', 'id');
    }
    
    
    
}
