<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Anggota_Kelompok;
use Illuminate\Routing\Controller;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Support\Facades\Auth;
use Carbon\Exceptions\InvalidFormatException;


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
        ->where('status_laporan', 'valid ')
        ->orderby('sesi_laporan_harian.tanggal', 'DESC');
        if (request('cari')) {
            $dataLap->where('nama_mhs', 'like', '%' . request('cari') . '%');
            $dataLap->Orwhere('nama_dosen', 'like', '%' . request('cari') . '%');
        }

        return view(
            'admin.siaca.checkLap.rekap',
            [
                'dataLap' => $dataLap->paginate(10)
            ]
        );
    }
    public function RekapVal(Request $request)
    {
        try {
            $tanggal = $request->tanggal ? Carbon::parse($request->tanggal) : now();
        } catch (InvalidFormatException $ex) {
            $tanggal = now();
        }
        $bulan = $request->bulan ? Carbon::parse($request->bulan) : now();
        $periodeBulan = $bulan->startOfMonth()->daysUntil($bulan->copy()->endOfMonth());
        $dataLap  = Sesi_Laporan_Harian::query()
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
                'nama_dosen'
                ]
            )
            // ->whereBetween('sesi_laporan_harian.tanggal', [$periodeBulan->first()->toDateString(), $periodeBulan->last()->toDateString()])
            // ->where('sesi_laporan_harian.tanggal', $tanggal->toDateString())
            ->orderby('tanggal')
            ->whereNot('laporan_mahasiswa.status_laporan', 'draf')
            ->where('laporan_mahasiswa.status_laporan', 'menunggu')
        ->orderby('nama_kelompok');
        if (request('tanggal')) {
            $dataLap->where('sesi_laporan_harian.tanggal', 'like', '%' . request('tanggal') . '%');
        }
        return view(
            'admin.siaca.checkLap.rekapVal',
            [
                'bulan' => $bulan,
                'periodeBulan' => $periodeBulan,

                'dataLap' => $dataLap->get(),
                'tanggal' => $tanggal
            ]
        );
    }
    public function ScoreDosen()
    {
        $ScoreDosen = Sesi_Laporan_Harian::query()
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
                    'dosen.nama_dosen'
                ]
            )
            ->orderBy('tanggal')
            ->whereIn('laporan_mahasiswa.status_laporan', ['draf', 'valid', 'menunggu']) // Ubah "status_laporan" yang valid dan menunggu
            ->orderBy('nama_kelompok')
            ->get();

        // Inisialisasi array untuk menyimpan perhitungan status laporan untuk setiap dosen
        $statusCounts = [];

        foreach ($ScoreDosen as $data) {
            $dosenId = $data->dosen_id;

            // Inisialisasi hitungan jika dosen belum ada dalam array
            if (!isset($statusCounts[$dosenId])) {
                $statusCounts[$dosenId] = [
                    'dosen' => $data->nama_dosen,
                    'valid' => 0,
                    'menunggu' => 0
                ];
            }

            // Hitung status laporan
            if ($data->status_laporan === 'valid') {
                $statusCounts[$dosenId]['valid']++;
            } elseif ($data->status_laporan === 'menunggu') {
                $statusCounts[$dosenId]['menunggu']++;
            }
        }

        

        return view(
            'admin.siaca.checkLap.score',
            [
                'ScoreDosen' => $ScoreDosen,
                'statusCounts' => $statusCounts

            ]
        );
    }
    public function ScoreMhs()
    {
        $ScoreDosen = Sesi_Laporan_Harian::query()
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
                    'dosen.nama_dosen'
                ]
            )
            ->orderBy('tanggal')
            ->whereIn('laporan_mahasiswa.status_laporan', ['draf', 'valid', 'menunggu']) // Ubah "status_laporan" yang valid dan menunggu
            ->orderBy('nama_kelompok')
            ->get();

        // Inisialisasi array untuk menyimpan perhitungan status laporan untuk setiap dosen
        $statusCounts = [];

        foreach ($ScoreDosen as $data) {
            $dosenId = $data->mahasiswa_id;
            
            // Inisialisasi hitungan jika dosen belum ada dalam array
            if (!isset($statusCounts[$dosenId])) {
                $statusCounts[$dosenId] = [
                    'mhs' => $data->nama_mhs,
                    'dosen' => $data->nama_dosen,
                    'kelompok' => $data->nama_kelompok,
                    'kelompok' => $data->nama_kelompok,
                    'valid' => 0,
                    'draf' => 0,
                    'menunggu' => 0,
                ];
            }

            // Hitung status laporan
            if ($data->status_laporan === 'valid') {
                $statusCounts[$dosenId]['valid']++;
            } elseif ($data->status_laporan === 'draf') {
                $statusCounts[$dosenId]['draf']++;
            } elseif ($data->status_laporan === 'menunggu') {
                $statusCounts[$dosenId]['menunggu']++;
            }

            
        }



        return view(
            'admin.siaca.checkLap.scoremhs',
            [
                'ScoreDosen' => $ScoreDosen,
                'statusCounts' => $statusCounts

            ]
        );
    }
}
