<?php

namespace App\Models;

use App\Models\DaftarNilai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;
    protected $table = "nilai";
    protected $fillable = ['daftar_nilai_id', 'mahasiswa_id', 'nilai_akhir'];


    
}
