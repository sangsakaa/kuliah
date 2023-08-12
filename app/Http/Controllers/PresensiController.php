<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\Daftar_Sesi_Harian;
use App\Models\Sesi_Harian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class PresensiController extends Controller
{
    public function index()
    {


        $UserPerMhs = Auth::user()->mahasiswa_id;
        $User = Anggota_Kelompok::where('mahasiswa_id', $UserPerMhs)->first();
        $SesiHarian = Sesi_Harian::query()
            ->join('kelompok', 'kelompok.id', 'sesi_harian.kelompok_id')
            ->where('kelompok_id', $User->kelompok_id)
            ->select('sesi_harian.id', 'tanggal', 'nama_kelompok')
            ->get();
        return view('admin.userMahasiswa.presensi.index', compact('SesiHarian', 'User'));
    }
    public function show(Sesi_Harian $sesi_Harian)
    {
        $UserPerMhs = Auth::user()->mahasiswa_id;
        $User = Anggota_Kelompok::where('mahasiswa_id', $UserPerMhs)->first();
        $SesiHarian = Sesi_Harian::where('kelompok_id', $User->kelompok_id)->get();
        $dataAnggota = Anggota_Kelompok::query()
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftjoin('daftar_sesi_harian', 'daftar_sesi_harian.anggota_kelompok_id', 'anggota_kelompok.id')
            ->select('anggota_kelompok.id', 'nama_mhs', 'keterangan', 'alasan')
            ->where('kelompok_id', $sesi_Harian->kelompok_id)
            ->orderby('nama_mhs')
            ->get();
        if ($dataAnggota->count() === 0) {
            $dataAnggota = Anggota_Kelompok::query()
                ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
                ->where('kelompok_id', $sesi_Harian->kelompok_id)
                ->get();
        }

        return view('admin.userMahasiswa.presensi.show', compact('SesiHarian', 'User', 'sesi_Harian', 'dataAnggota'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $SesiHarian = new Sesi_Harian();
        $SesiHarian->tanggal = $request->tanggal;
        $SesiHarian->kelompok_id = $request->kelompok_id;
        $SesiHarian->save();
        return redirect()->back();
    }
    public function storeSesi(Request $request)
    {
        foreach ($request->absen as $sesiId) {
            $existingEntry = Daftar_Sesi_Harian::where('sesi_harian_id', $request->sesi_harian_id)
                ->where('anggota_kelompok_id', $sesiId)
                ->first();

            if ($existingEntry) {
                $existingEntry->alasan = $request->alasan[$sesiId];
                $existingEntry->keterangan = $request->keterangan[$sesiId];
                $existingEntry->save();
            } else {
                $daftarSesi = new Daftar_Sesi_Harian();
                $daftarSesi->sesi_harian_id = $request->sesi_harian_id;
                $daftarSesi->anggota_kelompok_id = $sesiId;
                $daftarSesi->alasan = $request->alasan[$sesiId];
                $daftarSesi->keterangan = $request->keterangan[$sesiId];
                $daftarSesi->save();
            }
        }


        return redirect()->back();
    }
}
