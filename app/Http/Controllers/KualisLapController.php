<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan_Mahasiswa;

use Illuminate\Routing\Controller;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Support\Facades\Auth;


class KualisLapController extends Controller
{
    public function laporan(Sesi_Laporan_Harian $sesi_Laporan_Harian)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $cek_lap = Sesi_Laporan_Harian::query()
            ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->select(
                [
                    'kelompok.nama_kelompok',
                    // 'mahasiswa_id',
                    'anggota_kelompok.kelompok_id',
                    'mahasiswa.nama_mhs',
                    'sesi_laporan_harian.created_at',
                    'laporan_mahasiswa.updated_at',
                    'laporan_mahasiswa.status_laporan',
                    'laporan_mahasiswa.deskripsi_laporan',
                    'laporan_mahasiswa.kualitas_lap',
                    'laporan_mahasiswa.bukti_laporan',
                    'laporan_mahasiswa.id',
                    // 'sesi_laporan_harian.anggota_kelompok_id',
                    // 'sesi_laporan_harian.tanggal',
                    // 'sesi_laporan_harian.id',
                    'kelompok.dosen_id',
                    'dosen.nama_dosen'
                ]
            )
            ->orderBy('tanggal')
            ->whereIn('laporan_mahasiswa.status_laporan', ['draf', 'valid', 'menunggu']) // Ubah "status_laporan" yang valid dan menunggu
            ->orderBy('nama_kelompok')
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->whereNull('laporan_mahasiswa.kualitas_lap')
            ->paginate(2);



        return view('admin.siaca.checkLap.laporan', compact('cek_lap'));
    }
    public function updateChec(Request $request)
    {
        // dd($request);
        $idArray = $request->id;
        $kualitas_lapArray = $request->kualitas_lap;

        foreach ($idArray as $index => $id) {
            $sesiLaporan = Laporan_Mahasiswa::find($id);
            if ($sesiLaporan && isset($kualitas_lapArray[$index])) {
                $kualitas_lap = $kualitas_lapArray[$index]; // Mengambil kualitas_lap dari array yang sesuai
                $sesiLaporan->kualitas_lap = $kualitas_lap; // Menggunakan '->' untuk mengakses property 'kualitas_lap'
                $sesiLaporan->save();
            }
        }



        return redirect()->back();
    }
}
