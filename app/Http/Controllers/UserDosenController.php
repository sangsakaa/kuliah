<?php

namespace App\Http\Controllers;


use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Support\Carbon;
use App\Models\Anggota_Kelompok;
use App\Models\Sesi_Laporan_Harian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Exceptions\InvalidFormatException;

class UserDosenController extends Controller
{
    public function validasiLaporan(Request $request)
    {

        try {
            $tanggal = $request->tanggal ? Carbon::parse($request->tanggal) : now();
        } catch (InvalidFormatException $ex) {
            $tanggal = now();
        }
        $UserPerDosen = Auth::user()->dosen_id;
        $dataDosen = Dosen::query()
            ->join('kelompok', 'kelompok.dosen_id', '=', 'dosen.id')
            ->where('dosen.id', $UserPerDosen)
            ->first();
        $dataLaporan  = Sesi_Laporan_Harian::query()
            ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->select('sesi_laporan_harian.id', 'nama_kelompok', 'kelompok_id', 'sesi_laporan_harian.anggota_kelompok_id', 'laporan_mahasiswa.created_at', 'tanggal')
            ->where('kelompok.id', $dataDosen->id)
            ->where('sesi_laporan_harian.tanggal', $tanggal->toDateString())
            ->whereNot('laporan_mahasiswa.status_laporan', 'draf')
            ->orderby('tanggal');
        if (request('tanggal')) {
            $dataLaporan->where('tanggal', 'like', '%' . request('tanggal') . '%');
        }
        // dd($dataLaporan);
        return view('admin.userDosen.laporan.Sesilaporan', ([
            'UserPerDosen' => $UserPerDosen,
            'dataDosen' => $dataDosen,
            'dataLaporan' => $dataLaporan->get(),
            'tanggal' => $tanggal
        ]
        ));
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
    public function dataAnggota()
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $dataDosen = Kelompok::query()
            ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->leftjoin('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->leftjoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->where('dosen_id', $UserPerDosen)
            ->first();
        $dataAnggota = Kelompok::query()
            ->join('anggota_kelompok', 'anggota_kelompok.kelompok_id', 'kelompok.id')
            ->join('mahasiswa', 'mahasiswa.id', 'anggota_kelompok.mahasiswa_id')
            ->where('dosen_id', $UserPerDosen)
            ->orderby('nama_mhs')
            ->get();

        return view('admin.userDosen.laporan.Anggota', compact('dataDosen', 'dataAnggota'));
    }

    public function timeLine(Request $request)
    {
        try {
            $tanggal = $request->tanggal ? Carbon::parse($request->tanggal) : now();
        } catch (InvalidFormatException $ex) {
            $tanggal = now();
        }
        $bulan = $request->bulan ? Carbon::parse($request->bulan) : now();
        $periodeBulan = $bulan->startOfMonth()->daysUntil($bulan->copy()->endOfMonth());
        $UserPerDosen = Auth::user()->dosen_id;
        $dataKelompok = Kelompok::query()
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.kelompok_id', '=', 'kelompok.id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->select('kelompok.*', 'mahasiswa_id', 'nama_mhs')
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->orderby('nama_mhs')
            ->get();
        // dd($dataKelompok);
        $dataSesiLaporanHarian  = Sesi_Laporan_Harian::query()
            ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->select(
                [
                    'kelompok.nama_kelompok',
                'mahasiswa_id',
                    'anggota_kelompok.kelompok_id',
                    'mahasiswa.nama_mhs',
                    'laporan_mahasiswa.created_at',
                'sesi_laporan_harian.anggota_kelompok_id',
                    'sesi_laporan_harian.tanggal'
                ]
            )
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->whereBetween('sesi_laporan_harian.tanggal', [$periodeBulan->first()->toDateString(), $periodeBulan->last()->toDateString()])
            ->get();

        $dataSesi = $dataSesiLaporanHarian->groupBy('kelompok_id');
        $dataSesiPerAnggota = $dataSesiLaporanHarian->groupBy('nama_mhs');
        // dd($dataSesiPerAnggota);
        $dataRekapSesiPerAnggota = $dataKelompok
            ->keyBy('nama_mhs')
            ->map(function ($kelompok, $nama_mhs) use ($dataSesiPerAnggota, $periodeBulan) {
                foreach ($periodeBulan as $hari) {
                    $sesiPerbulan[] = [
                        'hari' => $hari,
                        'data' => isset($dataSesiPerAnggota[$nama_mhs]) ? $dataSesiPerAnggota[$nama_mhs]->firstWhere('tanggal', $hari->toDateString()) : null
                    ];
                }
                return [
                    'sesiPerBulan' => $sesiPerbulan,
                    'kelompok' => $kelompok
                ];
            });
        $dataRekapSesi = $dataKelompok
            ->keyBy('id')
            ->map(function ($kelompok, $kelompok_id) use ($dataSesi, $periodeBulan) {
                // dd($dataSesi); 
                foreach ($periodeBulan as $hari) {
                    $sesiPerbulan[] = [
                        'hari' => $hari,
                        'data' => $dataSesi->count() ? $dataSesi[$kelompok_id]->firstWhere('tanggal', $hari->toDateString()) : null
                    ];
                }
                return [
                    'sesiPerBulan' => $sesiPerbulan,
                    'kelompok' => $kelompok
                ];
            });
        
        // dd($dataRekapSesi);
        $dataLap  = Sesi_Laporan_Harian::query()
            ->leftjoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->leftjoin('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'sesi_laporan_harian.anggota_kelompok_id')
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
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
                'kelompok.dosen_id'
                ]
            )
            ->whereBetween('sesi_laporan_harian.tanggal', [$periodeBulan->first()->toDateString(), $periodeBulan->last()->toDateString()])
            ->where('sesi_laporan_harian.tanggal', $tanggal->toDateString())
            ->orderby('tanggal')
            ->whereNot('laporan_mahasiswa.status_laporan', 'draf')
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->get();
        return view(
            'admin.userDosen.laporan.rekapSesi',
            ([
                'bulan' => $bulan,
                'periodeBulan' => $periodeBulan,
                'dataRekapSesi' => $dataRekapSesi,
                'dataRekapSesiPerAnggota' => $dataRekapSesiPerAnggota,
                'dataLap' => $dataLap,
                'tanggal' => $tanggal
        ]
        ));
    }
    

    
}
