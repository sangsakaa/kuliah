<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\Daftar_Sesi_Harian;
use App\Models\Sesi_Harian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;


class PresensiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tanggal = $request->tanggal ? Carbon::parse($request->tanggal) : now();
        } catch (InvalidFormatException $ex) {
            $tanggal = now();
        }
        $UserPerMhs = Auth::user()->mahasiswa_id;
        $User = Anggota_Kelompok::where('mahasiswa_id', $UserPerMhs)->first();
        $SesiHarian = Sesi_Harian::query()
            ->join('kelompok', 'kelompok.id', 'sesi_harian.kelompok_id')
            ->where('kelompok_id', $User->kelompok_id)
            ->select('sesi_harian.id', 'tanggal', 'nama_kelompok')
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->orderby('tanggal')
            // ->where('sesi_harian.tanggal', $tanggal->toDateString())
            ->get();
        return view('admin.userMahasiswa.presensi.index', compact('SesiHarian', 'User', 'tanggal'));
    }
    public function show(Sesi_Harian $sesi_Harian)
    {
        $UserPerMhs = Auth::user()->mahasiswa_id;
        $User = Anggota_Kelompok::where('mahasiswa_id', $UserPerMhs)->first();
        $SesiHarian = Sesi_Harian::where('kelompok_id', $User->kelompok_id)->get();
        $dataAnggota = Anggota_Kelompok::query()
            ->join('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            // ->leftjoin('daftar_sesi_harian', 'daftar_sesi_harian.anggota_kelompok_id', 'anggota_kelompok.id')
            ->leftjoin('daftar_sesi_harian', function ($join) use ($sesi_Harian) {
                $join->on('daftar_sesi_harian.anggota_kelompok_id', '=', 'anggota_kelompok.id')
                    ->where('daftar_sesi_harian.sesi_harian_id', '=', $sesi_Harian->id);
            })
            ->select([
                'anggota_kelompok.id',
                'nama_mhs',
                'keterangan',
                'alasan'
            ])
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
        $request->validate([
            'tanggal' => [
                'required',
                'date',
                'before_or_equal:now',
            ],
        ]);
        $SesiHarian = new Sesi_Harian();

        // Pemeriksaan apakah sesi harian sudah ada untuk kelompok_id dan tanggal yang sama
        $existingSession = Sesi_Harian::where('kelompok_id', $request->kelompok_id)
        ->whereDate('tanggal', $request->tanggal)
        ->first();

        if (!$existingSession) {
            // Jika sesi harian belum ada, lakukan penyimpanan
            $SesiHarian->tanggal = $request->tanggal;
            $SesiHarian->kelompok_id = $request->kelompok_id;
            $SesiHarian->save();
        } else {
            // Jika sesi harian sudah ada, berikan pesan atau tindakan yang sesuai
            // Contoh: return response()->json(['message' => 'Sesi harian sudah ada untuk kelompok ini pada tanggal ini.'], 422);
        }

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
    public function rekapPresensi(Request $request)
    {
        try {
            $tanggal = $request->tanggal ? Carbon::parse($request->tanggal) : now();
        } catch (InvalidFormatException $ex) {
            $tanggal = now();
        }
        $SesiHarian = Sesi_Harian::query()
            ->join('kelompok', 'kelompok.id', 'sesi_harian.kelompok_id')
            ->select('sesi_harian.id', 'tanggal', 'nama_kelompok')
            ->orderby('tanggal')
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->where('sesi_harian.tanggal', $tanggal->toDateString())
            ->get();
        $dataAnggota = Anggota_Kelompok::query()
            ->rightjoin('kelompok', 'kelompok.id', '=', 'anggota_kelompok.kelompok_id')
            ->join('mahasiswa', 'mahasiswa.id', '=', 'anggota_kelompok.mahasiswa_id')
            ->join('daftar_sesi_harian', 'daftar_sesi_harian.anggota_kelompok_id', 'anggota_kelompok.id')
            ->join('sesi_harian', 'sesi_harian.id', 'daftar_sesi_harian.sesi_harian_id')
            // ->select('anggota_kelompok.id', 'nama_mhs', 'keterangan', 'alasan',)
            ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->whereIn('daftar_sesi_harian.keterangan', ['sakit', 'izin', 'alfa'])
            ->where('sesi_harian.tanggal', $tanggal->toDateString())
            ->get();
        return view('admin.userMahasiswa.presensi.rekap', compact('dataAnggota', 'SesiHarian', 'tanggal'));
    }
    public function destroy(Sesi_Harian $sesi_Harian)
    {
        Sesi_Harian::destroy('id', $sesi_Harian->id);
        Daftar_Sesi_Harian::where('sesi_harian_id', $sesi_Harian->id)->delete();
        return redirect()->back();
    }
}
