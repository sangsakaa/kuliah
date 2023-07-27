<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $UserPerDosen = Auth::user()->dosen_id;
        $data = Mahasiswa::where('id', $UserPermhs)->get();
        $dataDosen = Dosen::where('id', $UserPerDosen)->get();
        $putra = Mahasiswa::where('jenis_kelamin', 'L')->count();
        $putri = Mahasiswa::where('jenis_kelamin', 'P')->count();
        $dataKelompok = Kelompok::query()
            ->leftJoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('kelompok.id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nidn')
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->get();

        return view('/dashboard', compact('putra', 'putri', 'data', 'dataDosen', 'dataKelompok'));
    }
   
}