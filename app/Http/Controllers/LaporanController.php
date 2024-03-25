<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Kelompok;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function LaporanMahasiswa()
    {
        $periode = Periode::join('semester', 'semester.id', 'periode.semester_id')
        ->select('periode.id', 'nama_periode', 'nama_semester')
        ->get();
        $LapMhs = Kelompok::query()
            ->join('dosen', 'dosen.id', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', 'kelompok.desa_id')
            ->join('kecamatan', 'kecamatan.id', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', 'kecamatan.kabupaten_id')
            ->leftjoin('periode', 'periode.id', 'kelompok.periode_id')
            ->join('semester', 'semester.id', 'periode.semester_id')
            ->select('kelompok.id', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nama_dosen', 'nama_kelompok')
            // ->join('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->where('periode_id', $periode->last()->id)
            
            ->get();
        return view('admin.laporan.laporanUser', compact('LapMhs'));
    }
}
