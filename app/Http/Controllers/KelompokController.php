<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\Desa;
use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {

        $dataDesa = Desa::query()
            ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'desa.id')
            ->get();
        $dataDosen = Dosen::orderby('nama_dosen')->get();

        $dataKelompok = Kelompok::query()
            ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('kelompok.id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nidn')
            ->orderbY('nama_kelompok')
            ->get();
        return view('admin.kelompok.index', compact('dataKelompok', 'dataDosen', 'dataDesa'));
    }
    public function store(Request $request)
    {
        $kelompok = new Kelompok();
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->dosen_id = $request->dosen_id;
        $kelompok->desa_id = $request->desa_id;
        $kelompok->tahun = $request->tahun;
        $kelompok->save();
        return redirect()->back();
    }
    public function view(Kelompok $kelompok)
    {

        $tittle =
            Kelompok::query()
            ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
        ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
        ->select('kelompok.id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten')
            ->find($kelompok->id);
        $dataAnggota = Anggota_Kelompok::query()
            ->join('mahasiswa', 'mahasiswa.id', 'anggota_kelompok.mahasiswa_id')
            ->select('anggota_kelompok.id', 'nama_mhs', 'prodi', 'jenis_kelamin', 'nim')
            ->where('anggota_kelompok.kelompok_id', $kelompok->id)
            ->orderby('nama_mhs')
            ->get();
        return view('admin.kelompok.view', compact('kelompok', 'tittle', 'dataAnggota'));
    }
    public function insert(Kelompok $kelompok)
    {
        $tittle =
            Kelompok::query()
            ->leftjoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
        ->select('kelompok.id', 'nama_dosen', 'nama_kelompok',)
            ->find($kelompok->id);

        $pesertaTerpilih = Anggota_Kelompok::select('mahasiswa_id');
        $dataMahasiswa = Mahasiswa::first();
        $nim = substr($dataMahasiswa->nim, 0, 4);
        $dataMHS = Mahasiswa::leftJoinSub($pesertaTerpilih, 'anggota_Terpilih', function ($join) {
            $join->on('anggota_Terpilih.mahasiswa_id', '=', 'mahasiswa.id');
        })
            ->where('nim', 'like', $nim . '%')
            ->whereNull('anggota_Terpilih.mahasiswa_id')
            ->select('mahasiswa.id', 'nama_mhs', 'prodi', 'jenis_kelamin', 'nim')
            ->orderby('nim')

            ->get();


        return view('admin.kelompok.insert', compact('kelompok', 'tittle', 'dataMHS'));
    }
    public function storeAnggota(Request $request)
    {

        $anggotaKelompok = [];

        foreach ($request->mahasiswa as $item) {
            $anggota = [
                'mahasiswa_id' => $item,
                'kelompok_id' => $request->kelompok_id
            ];

            $anggotaKelompok[] = $anggota;
        }

        Anggota_Kelompok::insert($anggotaKelompok);

        return redirect()->back();
    }
    public function DestroAnggota(Anggota_Kelompok $anggota_Kelompok)
    {
        // dd($anggota_Kelompok);
        Anggota_Kelompok::destroy('id', $anggota_Kelompok->id);
        return redirect()->back();
    }
    public function destroy(Kelompok $kelompok)
    {

        Kelompok::destroy($kelompok->id);
        Anggota_Kelompok::where('kelompok_id', $kelompok->id)->delete();
        return redirect()->back();
    }
}
