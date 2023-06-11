<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Laporan_Mahasiswa;
use App\Models\Mahasiswa;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserPerMhsController extends Controller
{
    public function User()
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
        ->where('mahasiswa.id', $UserPermhs)
        ->first();
        return view('admin.userMahasiswa.user', compact('UserPermhs', 'data'));
    }
    public function sesiLap()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $dataKelompok = Kelompok::query()
            ->join('anggota_kelompok', 'anggota_kelompok.kelompok_id', '=', 'kelompok.id')
            ->where('mahasiswa_id', $UserPermhs)
            ->first();
        // dd($dataKelompok);
        $data = Mahasiswa::query()
            ->join('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->join('dosen', 'kelompok.dosen_id', '=', 'dosen.id')
            ->leftjoin('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->leftjoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('anggota_kelompok.mahasiswa_id', 'kelompok.dosen_id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nim', 'nama_mhs')
            ->where('mahasiswa.id', $UserPermhs)
            ->first();
        $DataSesiLap = Sesi_Laporan_Harian::query()
            ->join('kelompok', 'kelompok.id', '=', 'sesi_laporan_harian.kelompok_id')
            ->where('sesi_laporan_harian.kelompok_id', $dataKelompok->kelompok_id)
            ->select('sesi_laporan_harian.id', 'sesi_laporan_harian.kelompok_id', 'tanggal', 'nama_kelompok')
            ->get();
        // dd($DataSesiLap);

        return view('admin.userMahasiswa.laporan.Sesilaporan', compact('UserPermhs', 'data', 'dataKelompok', 'DataSesiLap'));
    }
    public function createSesiLap(Request $request)
    {
        $sesiLap = new Sesi_Laporan_Harian();
        $sesiLap->tanggal = $request->tanggal;
        $sesiLap->kelompok_id = $request->kelompok_id;
        // dd($sesiLap);
        $sesiLap->save();
        return redirect()->back();
    }
    public function laporan(Sesi_Laporan_Harian $sesi_Laporan_Harian)
    {

        // dd($sesi_Laporan_Harian);
        $UserPermhs = Auth::user()->mahasiswa_id;
        $data = Mahasiswa::query()
            ->join('anggota_kelompok', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->join('dosen', 'kelompok.dosen_id', '=', 'dosen.id')
            ->leftjoin('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->leftjoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('anggota_kelompok.mahasiswa_id', 'kelompok.dosen_id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nim', 'nama_mhs')
            ->where('mahasiswa.id', $UserPermhs)
            ->first();
        return view('admin.userMahasiswa.laporan.laporan', compact('data', 'sesi_Laporan_Harian'));
    }
    public function BuatLap(Request $request)
    {
        $Lap = Laporan_Mahasiswa::find($request->sesi_laporan_harian_id);

        if ($Lap) {
            $Lap->sesi_laporan_harian_id = $request->sesi_laporan_harian_id;
            $Lap->anggota_kelompok_id = $request->anggota_kelompok_id;
            $Lap->lokasi_praktik = $request->lokasi_praktik;
            $Lap->deskrip_laporan = $request->deskrip_laporan;
            $Lap->butkti_laporan = $request->butkti_laporan;
            $Lap->save();
        } else {
            $Lap = new Laporan_Mahasiswa();
            $Lap->sesi_laporan_harian_id = $request->sesi_laporan_harian_id;
            $Lap->anggota_kelompok_id = $request->anggota_kelompok_id;
            $Lap->lokasi_praktik = $request->lokasi_praktik;
            $Lap->deskrip_laporan = $request->deskrip_laporan;
            $Lap->butkti_laporan = $request->butkti_laporan;
            $Lap->save();
        }

        return redirect()->back();
        
    }
}
