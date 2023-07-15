<?php

namespace App\Models;

use App\Models\Laporan_Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisi extends Model
{
    use HasFactory;
    protected $table = "supervisi";
    protected $fillable = [
        'supervisi_id',
        // other fields...
    ];
    public function Super()
    {
        return $this->hasMany(Laporan_Supervisi::class, 'supervisi_id');
    }
}
