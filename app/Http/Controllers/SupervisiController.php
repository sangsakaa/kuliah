<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Supervisi;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use App\Models\Laporan_Mahasiswa;
use App\Models\Laporan_Supervisi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupervisiController extends Controller
{
    public function superVisi()
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $dataSupervisi = Supervisi::query()
            ->join('kelompok', 'kelompok.id', 'supervisi.kelompok_id')
            ->join('dosen', 'dosen.id', 'kelompok.dosen_id')
            ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
            ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
            ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->select('supervisi.id', 'nama_kecamatan', 'nama_desa', 'nama_kabupaten', 'nama_kelompok', 'nama_dosen', 'tanggal')
            ->where('dosen_id', $UserPerDosen)->get();
        return view('admin.userDosen.laporan.supervisi', compact('dataSupervisi'));
    }
    public function store(Request $request)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $Kelompok = Kelompok::where('dosen_id', $UserPerDosen)->first();
        $supervisi = new Supervisi();
        $supervisi->tanggal = now();
        $supervisi->kelompok_id = $Kelompok->id;

        if ($supervisi->save()) {
            echo "Data Berhasil Disimpan";
        } else {
            echo "Gagal Menyimpan Data";
        }
        return redirect()->back();
    }
    public function LapsuperVisi(Supervisi $supervisi)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $lapSupervisi = Kelompok::query()
            ->join('supervisi', 'kelompok.id', 'supervisi.kelompok_id')
            ->join('laporan_supervisi', 'supervisi.id', 'laporan_supervisi.supervisi_id')
            ->select('kelompok.dosen_id', 'kondisi_umum', 'realisasi_kegiatan', 'tidak_realisasi_kegiatan', 'kendala', 'rencana_tindak_lanjut', 'bukti_laporan_supervisi')
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->where('laporan_supervisi.supervisi_id', $supervisi->id)
            ->get();
        if ($lapSupervisi->count() === 0) {
            $lapSupervisi = Kelompok::query()
                ->select('kelompok.dosen_id')
                ->where('kelompok.dosen_id', $UserPerDosen)
                ->get();
        }
        return view('admin.userDosen.laporan.lapsupervisi', compact('supervisi', 'lapSupervisi'));
    }
    public function StoreLapsuperVisi(Request $request, Supervisi $supervisi)
    {
        $request->validate(
            [
                'bukti_laporan_supervisi' => 'max:1042',
            ],
            [
                'bukti_laporan_supervisi.max' => 'Ukuran file bukti laporan tidak boleh melebihi 1 MB.',
            ]
        );
        // dd($request);
        $supervisi = (int)$request->supervisi_id;
        // dd($supervisi);
        $Lap = Laporan_Supervisi::where('supervisi_id', $supervisi)
            ->first();
        // dd($Lap);
        if ($Lap) {
            $Lap->supervisi_id = $supervisi;
            $Lap->kondisi_umum = $request->kondisi_umum;
            $Lap->realisasi_kegiatan = $request->realisasi_kegiatan;
            $Lap->tidak_realisasi_kegiatan = $request->tidak_realisasi_kegiatan;
            $Lap->kendala = $request->kendala;
            $Lap->rencana_tindak_lanjut = $request->rencana_tindak_lanjut;
            if ($request->hasFile('bukti_laporan_supervisi')) {
                // Menghapus file laporan yang lama
                Storage::delete($Lap->bukti_laporan_supervisi);

                $file = $request->file('bukti_laporan_supervisi');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_laporan', $filename);
                $Lap->bukti_laporan_supervisi = 'bukti_laporan/' . $filename;
            }
            $Lap->save();
        } else {
            $Lap = new Laporan_Supervisi();
            $Lap->supervisi_id = $supervisi;
            $Lap->kondisi_umum = $request->kondisi_umum;
            $Lap->realisasi_kegiatan = $request->realisasi_kegiatan;
            $Lap->tidak_realisasi_kegiatan = $request->tidak_realisasi_kegiatan;
            $Lap->kendala = $request->kendala;
            $Lap->rencana_tindak_lanjut = $request->rencana_tindak_lanjut;
            if ($request->hasFile('bukti_laporan_supervisi')) {
                $file = $request->file('bukti_laporan_supervisi');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_laporan', $filename);
                $Lap->bukti_laporan_supervisi = 'bukti_laporan/' . $filename;
            }
            $Lap->save();
        }

        return redirect()->back();
    }
    public function CetakSupervisi(Supervisi $supervisi)
    {
        $UserPerDosen = Auth::user()->dosen_id;
        $title = $supervisi->join('kelompok', 'kelompok.id', '=', 'supervisi.kelompok_id')
        ->join('dosen', 'dosen.id', '=', 'kelompok.dosen_id')
        ->join('desa', 'desa.id', '=', 'kelompok.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('kabupaten', 'kabupaten.id', '=', 'kecamatan.kabupaten_id')
            ->where('kelompok.dosen_id', $UserPerDosen)
        ->first();
        $lapSupervisi = Kelompok::query()
            ->join('supervisi', 'kelompok.id', 'supervisi.kelompok_id')
            ->join('laporan_supervisi', 'supervisi.id', 'laporan_supervisi.supervisi_id')
            ->select('kelompok.dosen_id', 'kondisi_umum', 'realisasi_kegiatan', 'tidak_realisasi_kegiatan', 'kendala', 'rencana_tindak_lanjut', 'bukti_laporan_supervisi')
            ->where('kelompok.dosen_id', $UserPerDosen)
            ->where('laporan_supervisi.supervisi_id', $supervisi->id)
            ->get();
        return view(
            'admin.userDosen.laporan.cetaksupervisi',
            [
                'title' => $title,
                'UserPerDosen' => $UserPerDosen,
                'lapSupervisi' => $lapSupervisi
            ]
        );

    }
}
