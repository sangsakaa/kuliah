<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisi extends Model
{
    use HasFactory;
    protected $table = "supervisi";
    protected $fillable = [
        'supervisi_id',
        // other fields...
    ];
}
