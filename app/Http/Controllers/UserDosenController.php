<?php

namespace App\Http\Controllers;


use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Anggota_Kelompok;
use App\Models\Laporan_Mahasiswa;
use App\Models\Sesi_Laporan_Harian;
use App\Http\Controllers\Controller;
use App\Models\Kelompok;
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
        $dataLaporan  = Sesi_Laporan_Harian::query()
            ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->select('sesi_laporan_harian.id', 'nama_kelompok', 'kelompok_id', 'sesi_laporan_harian.anggota_kelompok_id', 'laporan_mahasiswa.created_at')
            ->where('kelompok.id', $dataDosen->id)
            ->orderby('tanggal')->get();
        // dd($dataLaporan);
        return view('admin.userDosen.laporan.Sesilaporan', compact('UserPerDosen', 'dataDosen', 'dataLaporan'));
    }
    public function DaftaValidasi(Sesi_Laporan_Harian $sesi_Laporan_Harian)
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $data = Mahasiswa::query()
            ->join('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->join('dosen', 'kelompok.dosen_id', '=', 'dosen.id')
            ->leftjoin('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->leftjoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('anggota_kelompok.mahasiswa_id', 'kelompok.dosen_id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nim', 'nama_mhs')
        ->where('anggota_kelompok.mahasiswa_id', $sesi_Laporan_Harian->anggota_kelompok_id)
        ->first();
        // dd($data);
        $UserPerDosen = Auth::user()->dosen_id;
        $dataMhs = Anggota_Kelompok::query()
            ->rightJoin('sesi_laporan_harian', 'sesi_laporan_harian.anggota_kelompok_id', '=', 'anggota_kelompok.id')
            ->rightJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->where('sesi_laporan_harian_id', $sesi_Laporan_Harian->id)
            ->get();



        return view('admin.userDosen.laporan.laporan', compact('dataMhs',  'sesi_Laporan_Harian', 'UserPerDosen', 'data'));
    }
}
