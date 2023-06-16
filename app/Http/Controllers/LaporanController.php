<?php

namespace App\Http\Controllers;

use App\Models\Sesi_Laporan_Harian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function LaporanMahasiswa()
    {
        $LapMhs = Sesi_Laporan_Harian::query()
            ->join('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')->get();
        return view('admin.laporan.laporanUser', compact('LapMhs'));
    }
}
