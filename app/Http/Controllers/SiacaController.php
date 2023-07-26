<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

use App\Models\Anggota_Kelompok;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class SiacaController extends Controller
{
    public function RekapLap()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;

        $dataLap = Anggota_Kelompok::query()
            ->leftJoin('sesi_laporan_harian', 'sesi_laporan_harian.anggota_kelompok_id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->where('status_laporan', 'menunggu ')
            ->Orwhere('status_laporan', 'valid ')
            ->get();
        return view('admin.siaca.checkLap.rekap', compact('dataLap'));
    }
}
