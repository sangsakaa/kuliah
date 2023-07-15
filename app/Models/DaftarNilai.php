<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarNilai extends Model
{
    use HasFactory;
    protected $table = "daftar_nilai";
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'daftar_nilai_id');
    }


}
