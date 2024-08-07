<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        // dd($UserPermhs);
        $UserPerDosen = Auth::user()->dosen_id;
        $dataMhs = Mahasiswa::where('id', $UserPermhs)->get();
        // dd($dataMhs);
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
        $dataPeriode = Periode::orderBy('id', 'desc')->first();
        
        $RekapLap = Sesi_Laporan_Harian::query()
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftJoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftJoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->leftJoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->select(
                'kelompok.nama_kelompok',
                'mahasiswa.id as mahasiswa_id',
                'anggota_kelompok.kelompok_id',
                'mahasiswa.nama_mhs',
                'sesi_laporan_harian.created_at',
                'laporan_mahasiswa.updated_at',
                'laporan_mahasiswa.status_laporan',
                'sesi_laporan_harian.anggota_kelompok_id',
                'sesi_laporan_harian.tanggal',
                'sesi_laporan_harian.id as sesi_laporan_harian_id',
                'kelompok.dosen_id',
                'dosen.nama_dosen'
            )
            ->orderBy('tanggal')
            ->orderBy('nama_kelompok')
            ->get();
        // Perhitungan jumlah status_laporan "menunggu" untuk setiap kelompok
        $jumlahMenungguPerKelompok = $RekapLap->groupBy('kelompok_id')
        ->map(function ($laporans) {
            return $laporans->where('status_laporan', 'valid')->count();
        })
            ->sortByDesc(function ($count) {
                return $count;
            });

        // Data untuk grafik bar
        $labels = $jumlahMenungguPerKelompok->keys()->map(function ($kelompok_id) use ($RekapLap) {
            $kelompok = $RekapLap->where('kelompok_id', $kelompok_id)->first();
            return $kelompok ? $kelompok->nama_kelompok . ' - ' . $kelompok->nama_dosen : 'Nama Kelompok Tidak Ditemukan';
        });
        $data = $jumlahMenungguPerKelompok->values();

        // Buat array untuk menyimpan jumlah status_laporan setiap dosen
        $UserPermhs = Auth::user()->mahasiswa_id;
        $dataLapMhs = Sesi_Laporan_Harian::query()
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftJoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftJoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->leftJoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->select(
                'kelompok.nama_kelompok',
                'mahasiswa.id as mahasiswa_id',
                'anggota_kelompok.kelompok_id',
                'mahasiswa.nama_mhs',
                'sesi_laporan_harian.created_at',
                'laporan_mahasiswa.updated_at',
                'laporan_mahasiswa.status_laporan',
                'sesi_laporan_harian.anggota_kelompok_id',
                'sesi_laporan_harian.tanggal',
                'sesi_laporan_harian.id as sesi_laporan_harian_id',
                'kelompok.dosen_id',
                'dosen.nama_dosen'
            )
            ->where('mahasiswa_id', $UserPermhs)
            ->orderBy('tanggal')
            ->orderBy('nama_kelompok')
            ->where('kelompok.periode_id', $dataPeriode->id)
            ->get();
        // Assuming $dataLapMhs is the data fetched using the query provided in your code

        // Initialize status count
        $statusCount = [
            'menunggu' => 0,
            'valid' => 0,
            'draf' => 0,
        ];

        // Calculate count of each status
        foreach ($dataLapMhs as $data) {
            if ($data->status_laporan === 'menunggu') {
                $statusCount['menunggu']++;
            } elseif ($data->status_laporan === 'valid') {
                $statusCount['valid']++;
            } elseif ($data->status_laporan === 'draf') {
                $statusCount['draf']++;
            }
        }

        // Convert the status count data to be used in the chart
        $statusChartData = [
            'labels' => ['Menunggu', 'Valid', 'Draf'],
            'data' => [$statusCount['menunggu'], $statusCount['valid'], $statusCount['draf']],
        ];
        $UserPerDosen = Auth::user()->dosen_id;
        $dataPeriode = Periode::orderBy('id', 'desc')->first();
        $dataLapDosen = Sesi_Laporan_Harian::query()
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftJoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftJoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->leftJoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->select(
                'kelompok.nama_kelompok',
                'mahasiswa.id as mahasiswa_id',
                'anggota_kelompok.kelompok_id',
                'mahasiswa.nama_mhs',
                'sesi_laporan_harian.created_at',
                'laporan_mahasiswa.updated_at',
                'laporan_mahasiswa.status_laporan',
                'sesi_laporan_harian.anggota_kelompok_id',
                'sesi_laporan_harian.tanggal',
                'sesi_laporan_harian.id as sesi_laporan_harian_id',
                'kelompok.dosen_id',
            'dosen.nama_dosen',
            'kelompok.periode_id'
            )
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->orderBy('tanggal')
            ->orderBy('nama_kelompok')
            ->where('kelompok.periode_id', $dataPeriode->id)
            ->get();
        // Assuming $dataLapMhs is the data fetched using the query provided in your code

        // Initialize status count
        $statusCount = [
            'menunggu' => 0,
            'valid' => 0,
            'draf' => 0,
        ];

        // Calculate count of each status
        foreach ($dataLapDosen as $data) {
            if ($data->status_laporan === 'menunggu') {
                $statusCount['menunggu']++;
            } elseif ($data->status_laporan === 'valid') {
                $statusCount['valid']++;
            } elseif ($data->status_laporan === 'draf') {
                $statusCount['draf']++;
            }
        }

        // Convert the status count data to be used in the chart
        $statusChartDataDosen = [
            'labels' => ['Menunggu', 'Valid', 'Draf'],
            'data' => [$statusCount['menunggu'], $statusCount['valid'], $statusCount['draf']],
        ];


        // Buat array untuk menyimpan jumlah status_laporan setiap dosen

        return view('/dashboard', compact('putra', 'putri', 'data', 'dataDosen', 'dataKelompok', 'labels', 'data', 'dataMhs', 'dataLapMhs', 'statusChartData', 'dataLapDosen', 'statusChartDataDosen'));
    }
   
}