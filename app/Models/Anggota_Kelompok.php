<?php

namespace App\Models;


use App\Models\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota_Kelompok extends Model
{
    use HasFactory;
    protected $table = "anggota_kelompok";



    public function Mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id', 'mahasiswa_id');
    }

    public function DetailMahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id', 'mahasiswa_id');
    }

    

    




   
}
