<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file_screening extends Model
{
    use HasFactory;
    protected $table = "file_screening";
    protected $fillable = [
        'mahasiswa_id',
        'file',
        'status_file',
    ];
}
