<?php

namespace App\Models;

use App\Models\Anggota_Kelompok;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan_Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "laporan_mahasiswa";

    public function sesiLaporanHarian()
    {
        return $this->belongsTo(Sesi_Laporan_Harian::class,);
    }

    

    



}
