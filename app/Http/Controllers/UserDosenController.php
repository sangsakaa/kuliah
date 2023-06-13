<?php

namespace App\Http\Controllers;


use App\Models\Dosen;
use App\Models\Mahasiswa;
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
        $dataLaporan  = Sesi_Laporan_Harian::query()
            ->join('kelompok', 'sesi_laporan_harian.kelompok_id', '=', 'kelompok.id')
            ->select('sesi_laporan_harian.created_at', 'nama_kelompok', 'sesi_laporan_harian.id', 'tanggal')
            ->where('sesi_laporan_harian.kelompok_id', $dataDosen->id)
            ->orderby('tanggal')->get();
        return view('admin.userDosen.laporan.Sesilaporan', compact('UserPerDosen', 'dataDosen', 'dataLaporan'));
    }
    public function DaftaValidasi(Sesi_Laporan_Harian $sesi_Laporan_Harian)
    {
        $UserPermhs = Auth::user()->dosen_id;
        $data = Mahasiswa::query()
            ->join('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->join('dosen', 'kelompok.dosen_id', '=', 'dosen.id')
            ->leftjoin('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->leftjoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('anggota_kelompok.mahasiswa_id', 'kelompok.dosen_id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nim', 'nama_mhs')
            ->where('mahasiswa.id', $UserPermhs)
            ->first();
        // dd($UserPermhs);
        $dataMhs = Anggota_Kelompok::query()
            ->leftjoin('kelompok', 'anggota_kelompok.kelompok_id', '=', 'kelompok.id')
            ->leftjoin('laporan_mahasiswa', 'anggota_kelompok.mahasiswa_id', '=', 'laporan_mahasiswa.anggota_kelompok_id')
            ->leftjoin('sesi_laporan_harian', 'sesi_laporan_harian.id', '=', 'laporan_mahasiswa.sesi_laporan_harian_id')
            ->where('kelompok.dosen_id', $UserPermhs)
            ->select(
                [
                    'kelompok.dosen_id',
                    'anggota_kelompok.mahasiswa_id',
                    'laporan_mahasiswa.*'
                ]
            )
            ->where('laporan_mahasiswa.sesi_laporan_harian_id', $sesi_Laporan_Harian->id)
            ->get();
        // dd($dataMhs);
        if ($dataMhs->count() == 0) {
            $dataMhs = Anggota_Kelompok::query()->where('anggota_kelompok.mahasiswa_id', $UserPermhs)->get();
        }
        return view('admin.userDosen.laporan.laporan', compact('dataMhs', 'data', 'sesi_Laporan_Harian', 'UserPermhs'));
    }
}
