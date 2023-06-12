<?php

namespace App\Http\Controllers;


use App\Models\Dosen;
use App\Models\Anggota_Kelompok;
use App\Models\Laporan_Mahasiswa;
use App\Models\Sesi_Laporan_Harian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDosenController extends Controller
{
    public function validasiLaporan()
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $dataDosen = Dosen::query()
            ->join('kelompok', 'kelompok.dosen_id', '=', 'dosen.id')
            ->where('dosen.id', $UserPerDosen)
            ->first();
        $dataLaporan  = Sesi_Laporan_Harian::all();
        return view('admin.userDosen.laporan.Sesilaporan', compact('UserPerDosen', 'dataDosen', 'dataLaporan'));
    }
    public function DaftaValidasi(Sesi_Laporan_Harian $sesi_Laporan_Harian)
    {
        $daftarLapMhs = Anggota_Kelompok::query()
            ->leftjoin('laporan_mahasiswa', 'anggota_kelompok.mahasiswa_id', '=', 'laporan_mahasiswa.anggota_kelompok_id')
            ->leftjoin('sesi_laporan_harian', 'sesi_laporan_harian.id', '=', 'laporan_mahasiswa.sesi_laporan_harian_id')

            // ->where('laporan_mahasiswa.sesi_laporan_harian_id', $sesi_Laporan_Harian->id)
            ->get();
        return view('admin.userDosen.laporan.laporan', compact('daftarLapMhs'));
    }
}
