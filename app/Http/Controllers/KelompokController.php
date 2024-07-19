<?php

namespace App\Http\Controllers;

use App\Models\Anggota_Kelompok;
use App\Models\Desa;
use App\Models\Dosen;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\Periode;
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
        $periode = Periode::join('semester', 'semester.id', 'periode.semester_id')
        ->select('periode.id', 'nama_periode', 'nama_semester')
        ->get();
        // dd($periode);
        $dataKelompok = Kelompok::query()
            ->leftJoin('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->leftjoin('periode', 'periode.id', 'kelompok.periode_id')
            ->join('semester', 'semester.id', 'periode.semester_id')
            ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('kelompok.id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nidn', 'nama_periode', 'nama_semester', 'periode.id as id_periode')
        ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
            ->where('periode.id', $periode->last()->id)
        ->get();
        // dd($dataKelompok);
        return view('admin.kelompok.index', compact('dataKelompok', 'dataDosen', 'dataDesa', 'periode'));
    }
    public function editKelompok(Kelompok $kelompok)
    {
        $dataDosen = Dosen::orderby('nama_dosen')->get();
        $dataDesa = Desa::join('kecamatan', 'kecamatan.id', 'desa.kecamatan_id')
        ->join('kabupaten', 'kabupaten.id', 'kecamatan.kabupaten_id')
        ->select('desa.id', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten')
        ->get();

        return view(
            'admin.kelompok.edit_kelompok',
            [
                'kelompok' => $kelompok,
                'dataDesa' => $dataDesa,
                'dataDosen' => $dataDosen,
               
            ]
        );
    }
    public function store(Request $request)
    {
        $kelompok = new Kelompok();
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->dosen_id = $request->dosen_id;
        $kelompok->desa_id = $request->desa_id;
        $kelompok->tahun = $request->tahun;
        $kelompok->periode_id = $request->periode_id;
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
        ->select('kelompok.id', 'nama_dosen', 'nama_kelompok', 'nama_desa', 'nama_kecamatan', 'nama_kabupaten', 'nidn')
            ->find($kelompok->id);
        $dataAnggota = Anggota_Kelompok::query()
            ->join('mahasiswa', 'mahasiswa.id', 'anggota_kelompok.mahasiswa_id')
            ->join('kelompok', 'kelompok.id', 'anggota_kelompok.kelompok_id')
            ->select('anggota_kelompok.id', 'nama_mhs', 'prodi', 'jenis_kelamin', 'nim', 'nama_kelompok', 'mahasiswa_id', 'kelompok_id')
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
        // $nim = substr($dataMahasiswa->nim, 0, 4);
        $dataMHS = Mahasiswa::leftJoinSub($pesertaTerpilih, 'anggota_Terpilih', function ($join) {
            $join->on('anggota_Terpilih.mahasiswa_id', '=', 'mahasiswa.id');
        })
            ->where('nim', 'like', 2021 . '%')
           
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
    public function edit(Anggota_Kelompok $anggota_Kelompok, Kelompok $kelompok)
    {
        // dd($kelompok);

        
        $Mhs = $anggota_Kelompok->join('mahasiswa', 'anggota_kelompok.mahasiswa_id', '=', 'mahasiswa.id')
            // ->select('nama_mhs',)
            ->where('mahasiswa_id', $anggota_Kelompok->mahasiswa_id)
        ->first();

        $dataKelompok = Kelompok::leftjoin('periode', 'periode.id', 'kelompok.periode_id')
        ->join('semester', 'semester.id', 'periode.semester_id')
        ->select(
            'periode.id as id_periode',
            'kelompok.id'
        )
        ->orderByRaw('CAST(nama_kelompok AS SIGNED) asc')
        ->where('kelompok.id', $Mhs->id)
        ->get();
        
        return view('admin.kelompok.edit', compact('anggota_Kelompok', 'dataKelompok',  'kelompok', 'Mhs'));
    }
    public function update(Request $request, Anggota_Kelompok $anggota_Kelompok)
    {
        // dd($request);
        Anggota_Kelompok::where('id', $anggota_Kelompok->id)
            ->update([
                'kelompok_id' => $request->kelompok_id,
            ]);
        return redirect()->back();
    }
    public function updateKelompok(Request $request, Kelompok $kelompok)
    {
        // dd($request);
        Kelompok::where('id', $kelompok->id)
            ->update([
                'dosen_id' => $request->dosen_id,
                'nama_kelompok' => $request->nama_kelompok,
                'desa_id' => $request->desa_id,
            ]);
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
