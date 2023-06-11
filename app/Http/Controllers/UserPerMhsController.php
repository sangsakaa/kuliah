<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserPerMhsController extends Controller
{
    public function User()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $data = Mahasiswa::query()
        ->join('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
        ->join('dosen', 'kelompok.dosen_id', '=', 'dosen.id')
        ->where('mahasiswa.id', $UserPermhs)
        ->first();
        return view('admin.userMahasiswa.user', compact('UserPermhs', 'data'));
    }
}
