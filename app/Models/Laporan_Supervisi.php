<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Supervisi extends Model
{
    use HasFactory;
    protected $table = "laporan_supervisi";
    protected $fillable = [
        'kondisi_umum',
        // Add other fillable attributes here
    ];
}
