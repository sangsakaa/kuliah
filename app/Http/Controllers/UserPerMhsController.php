<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Anggota_Kelompok;
use App\Models\Laporan_Mahasiswa;
use Illuminate\Routing\Controller;
use App\Models\Sesi_Laporan_Harian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // dd($data);
        $DataSesiLap = Sesi_Laporan_Harian::query()    
            ->orderby('tanggal')

            ->where('anggota_kelompok_id', $data->mahasiswa_id)
            ->get();
        // dd($DataSesiLap);

        return view('admin.userMahasiswa.laporan.Sesilaporan', compact('UserPermhs', 'data', 'dataKelompok', 'DataSesiLap'));
    }
    public function createSesiLap(Request $request)
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $sesiLap = new Sesi_Laporan_Harian();
        $sesiLap->anggota_kelompok_id = $UserPermhs;
        $sesiLap->tanggal = $request->tanggal;
        $sesiLap->save();
        return redirect()->back()->with('error', 'sesi laporan berhasi di buat');
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
        // dd($UserPermhs);
        $dataMhs = Anggota_Kelompok::query()
            ->leftJoin('sesi_laporan_harian', 'sesi_laporan_harian.anggota_kelompok_id', '=', 'anggota_kelompok.mahasiswa_id')
            ->leftJoin('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', '=', 'sesi_laporan_harian.id')
            ->where('sesi_laporan_harian_id', $sesi_Laporan_Harian->id)
            ->where('anggota_kelompok.mahasiswa_id', $UserPermhs)
        ->get();
        // dd($dataMhs);
        if ($dataMhs->count() === 0) {
            $dataMhs = Anggota_Kelompok::query()->where('mahasiswa_id', $UserPermhs)->get();
        }
        
        return view('admin.userMahasiswa.laporan.laporan', compact('dataMhs', 'data', 'sesi_Laporan_Harian', 'UserPermhs'));
    }
    public function BuatLap(Request $request, Sesi_Laporan_Harian $sesi_Laporan_Harian)

    {
        $sesi_Laporan_Harian = (int) $request->sesi_laporan_harian_id;

        $Lap = Laporan_Mahasiswa::where('sesi_laporan_harian_id', $sesi_Laporan_Harian)->first();

        if ($Lap) {
            $Lap->lokasi_praktik = $request->lokasi_praktik;
            $Lap->deskripsi_laporan = $request->deskripsi_laporan;
            $Lap->status_laporan = $request->status_laporan ?? 'menunggu';
            $Lap->note_laporan = $request->note_laporan;

            if ($request->hasFile('bukti_laporan')) {
                // Menghapus file laporan yang lama
                Storage::delete($Lap->bukti_laporan);

                $file = $request->file('bukti_laporan');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_laporan', $filename);
                $Lap->bukti_laporan = 'bukti_laporan/' . $filename;
            }

            $Lap->save();
        } else {
            $Lap = new Laporan_Mahasiswa();
            $Lap->sesi_laporan_harian_id = $sesi_Laporan_Harian;
            $Lap->lokasi_praktik = $request->lokasi_praktik;
            $Lap->deskripsi_laporan = $request->deskripsi_laporan;
            $Lap->status_laporan = $request->status_laporan ?? 'menunggu';
            $Lap->note_laporan = $request->note_laporan;

            if ($request->hasFile('bukti_laporan')) {
                $file = $request->file('bukti_laporan');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_laporan', $filename);
                $Lap->bukti_laporan = 'bukti_laporan/' . $filename;
            }
            $Lap->save();
        }

        return redirect()->back();
    }
    public function RekapLapHarian()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $rekapLapHarian = Sesi_Laporan_Harian::query()
            ->join('laporan_mahasiswa', 'laporan_mahasiswa.sesi_laporan_harian_id', 'sesi_laporan_harian.id')
            ->where('sesi_laporan_harian.anggota_kelompok_id', $UserPermhs)
            ->where(function ($query) {
                $query->whereIn('laporan_mahasiswa.status_laporan', ['valid', 'menunggu']);
            })
            ->select('tanggal', 'sesi_laporan_harian.id', 'sesi_laporan_harian.anggota_kelompok_id', 'status_laporan')
            ->groupBy('tanggal', 'sesi_laporan_harian.id', 'sesi_laporan_harian.anggota_kelompok_id', 'status_laporan')
            ->get();


        return view('admin.userMahasiswa.laporan.rekaplaporan', compact('rekapLapHarian'));

        
        
    }
}
