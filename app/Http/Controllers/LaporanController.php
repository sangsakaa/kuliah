<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\Kelompok;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function LaporanMahasiswa()
    {
        $LapMhs = Kelompok::query()
            ->join('dosen', 'dosen.id', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', 'kelompok.desa_id')
            ->join('kecamatan', 'kecamatan.id', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', 'kecamatan.kabupaten_id')
            ->select('kelompok.id', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nama_dosen', 'nama_kelompok')
            // ->join('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            
            ->get();
        return view('admin.laporan.laporanUser', compact('LapMhs'));
    }
}
