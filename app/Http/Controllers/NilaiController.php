<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\DaftarNilai;
use App\Models\Kelompok;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function DaftarNilai()
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $daftarNilai = DaftarNilai::query()
            ->join('kelompok', 'kelompok.id', '=', 'daftar_nilai.kelompok_id')
            ->join('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->select('daftar_nilai.id', 'nama_kelompok', 'nama_dosen')
            ->where('dosen_id', $UserPerDosen)
            ->get();
        return view('admin.nilai.daftar', compact('daftarNilai'));
    }
    public function StoreDaftar(Request $request,)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $Kelompok = Kelompok::where('dosen_id', $UserPerDosen)->first();
        $daftarNilai = new DaftarNilai();
        $daftarNilai->kelompok_id = $Kelompok->id;
        $daftarNilai->save();
        return redirect()->back();
    }
    public function nilaiAkhir(DaftarNilai $daftarNilai)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $Kelompok = Kelompok::where('dosen_id', $UserPerDosen)->first();
        $dataAnggota = Anggota_Kelompok::query()
            ->join('mahasiswa', 'mahasiswa.id', 'anggota_kelompok.mahasiswa_id')
            ->join('kelompok', 'kelompok.id', 'anggota_kelompok.kelompok_id')
            ->leftjoin('daftar_nilai', 'daftar_nilai.kelompok_id', 'kelompok.id')
            ->leftjoin('nilai', 'nilai.mahasiswa_id', 'anggota_kelompok.id')
            // anggotanilai
            ->select('anggota_kelompok.id', 'nama_mhs', 'prodi', 'nama_kelompok', 'nilai_akhir')
            ->where('anggota_kelompok.kelompok_id', $Kelompok->id)
            ->orderby('nama_mhs')
            // ->groupby('anggota_kelompok.id', 'mahasiswa.nama_mhs', 'mahasiswa.prodi', 'kelompok.nama_kelompok')
            // ->where('daftar_nilai_id', $daftarNilai->id)
            ->get();
        // dd($dataAnggota->toArray());
        return view('admin.nilai.nilai', compact('dataAnggota', 'daftarNilai'));
    }
    public function storeNilai(Request $request)
    {
        // dd($request);

        foreach ($request->mahasiswa_id as $mahasiswaId) {
            $nilai = Nilai::firstOrNew(['mahasiswa_id' => $mahasiswaId, 'daftar_nilai_id' => $request->daftar_nilai_id]);

            $nilai->nilai_akhir = $request->nilai_akhir[$mahasiswaId];
            $nilai->save();
        }

        return redirect()->back();
    }
}
