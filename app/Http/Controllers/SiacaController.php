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
            ->join('kelompok', 'kelompok.id', 'anggota_kelompok.kelompok_id')
            ->join('dosen', 'dosen.id', 'kelompok.dosen_id')
            ->leftJoin('sesi_laporan_harian', 'sesi_laporan_harian.anggota_kelompok_id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
        ->where('status_laporan', 'valid ')->orderby('nama_kelompok')->orderby('sesi_laporan_harian.tanggal');
        if (request('cari')) {
            $dataLap->where('nama_mhs', 'like', '%' . request('cari') . '%')->orderBy('nama_mhs');
        }

        return view(
            'admin.siaca.checkLap.rekap',
            [
                'dataLap' => $dataLap->paginate(10)
            ]
        );
    }
}
