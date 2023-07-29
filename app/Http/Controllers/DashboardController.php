<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Sesi_Laporan_Harian;
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
        $dataLap = Sesi_Laporan_Harian::query()
        ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
        ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
        ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
        ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
        ->select(
            [
                'kelompok.nama_kelompok',
                'mahasiswa_id',
                'anggota_kelompok.kelompok_id',
                'mahasiswa.nama_mhs',
                'sesi_laporan_harian.created_at',
                'laporan_mahasiswa.updated_at',
                'laporan_mahasiswa.status_laporan',
                'sesi_laporan_harian.anggota_kelompok_id',
                'sesi_laporan_harian.tanggal',
                'sesi_laporan_harian.id',
                'kelompok.dosen_id',
                'dosen.nama_dosen' // Modified: Get the 'nama_dosen' from the 'dosen' table
            ]
        )
            ->orderBy('tanggal')
            ->orderBy('nama_kelompok')
            ->get()
            ->map(function ($item) {
                $item->status_laporan = $item->status_laporan == 'valid' ? 'menunggu' : 'draf'; // Modified: Convert 'valid' to 'menunggu', otherwise set to 'draf'
                return $item;
            });


        return view('/dashboard', compact('putra', 'putri', 'data', 'dataDosen', 'dataKelompok', 'dataLap'));
    }
   
}