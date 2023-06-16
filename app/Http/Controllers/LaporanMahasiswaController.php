<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class LaporanMahasiswaController extends Controller
{
    public function LaporanDataMahasiswa()

    {
        $dataMahasiswa = Mahasiswa::first();
        $nim = substr($dataMahasiswa->nim, 0, 4);
        $data = Mahasiswa::select('prodi', 'periode_masuk', DB::raw('count(*) as total'))
            ->select('nama_mhs', 'prodi', 'periode_masuk', 'jenis_kelamin', 'nim')
            ->groupBy('prodi', 'periode_masuk', 'nama_mhs', 'jenis_kelamin', 'nim')
            ->where('nim', 'like', $nim . '%')
            ->orderby('nim')
            ->get();
        return view('admin.mahasiswa.laporan.laporanMhs', compact('data', 'dataMahasiswa'));
    }
    
}
