<?php

namespace App\Models;



use App\Models\Anggotaasrama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";
    public function anggota()
    {
        return $this->hasMany(Anggotaasrama::class, 'mahasiswa_id', 'id');
    }
}
