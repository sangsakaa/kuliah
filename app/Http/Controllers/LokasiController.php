<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Provinsi $provinsi)
    {

        $provinsis = Provinsi::all();
        $kab = Kabupaten::join('provinsi', 'kabupaten.provinsi_id', 'provinsi.id')
            ->select('provinsi.nama_provinsi', 'kabupaten.nama_kabupaten', 'kabupaten.id')
            ->get();
        return view(
            'admin.lokasi.lokasi',
            [
                'kab' => $kab,
                'provinsis' => $provinsis,
                'provinsi' => $provinsi
            ]
        );
    }
    public function createKab(Request $request, Kabupaten $kabupaten)
    {
        $kab = new Kabupaten();
        $kab->provinsi_id = $request->provinsi_id;
        $kab->nama_kabupaten = $request->nama_kabupaten;
        $kab->save();
        return redirect()->route('admin.lokasi.kecamatan', ['id' => $kabupaten->id]);
    }
    public function createKec(Request $request)
    {
        $kab = new Kecamatan();
        $kab->kabupaten_id = $request->kabupaten_id;
        $kab->nama_kecamatan = $request->nama_kecamatan;
        $kab->save();
        return redirect()->back();
    }
    public function createDes(Request $request)
    {
        $kab = new Desa();
        $kab->kecamatan_id = $request->kecamatan_id;
        $kab->nama_desa = $request->nama_desa;
        $kab->save();
        return redirect()->back();
    }
    public function LokasiKec(Kabupaten $kabupaten)
    {

        $kecamatan = Kecamatan::join('kabupaten', 'kecamatan.kabupaten_id', 'kabupaten.id')
            ->select('nama_kecamatan', 'nama_kabupaten', 'kecamatan.id')
            ->where('kabupaten_id', $kabupaten->id)
            ->get();
        return view(
            'admin.lokasi.kecamatan',
            [
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan
            ]
        );
    }
    public function LokasiDes(Kecamatan $kecamatan)
    {

        $desa = Desa::join('kecamatan', 'kecamatan.id', 'desa.kecamatan_id')
            ->where('kecamatan_id', $kecamatan->id)->get();
        return view(
            'admin.lokasi.desa',
            [
                'kecamatan' => $kecamatan,
                'desa' => $desa,
            ]
        );
    }
}
