<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban_screening extends Model
{
    use HasFactory;
    protected $table = 'jawaban_screening';
    protected $fillable = [
        'mahasiswa_id',
        'screening_id',
        'jawaban',
        'keterangan',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(file_screening::class, 'mahasiswa_id');
    }
    
}
