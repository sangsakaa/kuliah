<?php

namespace App\Models;

use App\Models\Laporan_Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sesi_Laporan_Harian extends Model
{
    use HasFactory;
    protected $table = "sesi_laporan_harian";

    public function sesimahasiswa()
    {
        return $this->hasMany(Laporan_Mahasiswa::class, 'sesi_laporan_hari_id', 'id');
    }

}
