<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mahasiswa;
use App\Models\screening;

use Illuminate\Http\Request;
use App\Models\jawaban_screening;
use Illuminate\Routing\Controller;


class ScreeningController extends Controller
{
    public function index()
    {
        $dataScreening = jawaban_screening::query()
            ->join('mahasiswa', 'mahasiswa.id', '=', 'jawaban_screening.mahasiswa_id')
            ->select('mahasiswa.nama_mhs', 'jawaban_screening.mahasiswa_id', 'jawaban_screening.jawaban', 'prodi', 'nim')
        ->get();
        // Mengelompokkan data berdasarkan mahasiswa_id
        $groupedData = $dataScreening
        ->sortBy('prodi')
        // ->sortBy('nama_mhs')
        ->groupBy('mahasiswa_id');
        // Menghitung jumlah mahasiswa berdasarkan prodi
        $countProdi = $dataScreening->groupBy('prodi')->map(function ($items, $key) {
            $mahasiswaIdCount = $items->unique('mahasiswa_id')->count();
            return [

                'unique_mahasiswa_id' => $mahasiswaIdCount
            ];
        });


        // Menampilkan nama prodi dengan jumlahnya
        



        

        return view(
            'admin.mahasiswa.screening.index',
            compact('dataScreening', 'groupedData', 'countProdi')

        );
    }
    public function destroy_screening($mahasiswa_id)
    {
        jawaban_screening::where('mahasiswa_id', $mahasiswa_id)->delete();
        return redirect()->back();

    }
    public function screening(Request $request)
    {

        $mahasiswa = Mahasiswa::query();
        $soal = screening::query()
            // ->rightjoin('jawaban_screening', 'jawaban_screening.screening_id', 'screening.id')
            // ->select('screening.id', 'jawaban', 'soal')
            ->get();
        

        if (request('cari') !== null) {
            $mahasiswa->where('nim', '=', request('cari'));
        }
        $jawaban = jawaban_screening::query()
            ->join('mahasiswa', 'mahasiswa.id', 'jawaban_screening.mahasiswa_id')
            ->join('screening', 'jawaban_screening.screening_id', 'screening.id')
            ->where('mahasiswa.nim', request('cari'))
            // ->select('nim')
            // ->where('nim', 20205110109)
            ->get()
            ->mapWithKeys(function ($jawaban,) {
                return [
                $jawaban->screening_id => $jawaban
                ];
            });
        // dd($jawaban);

        return view(
            'admin.mahasiswa.screening.screening',
            [
                'mahasiswa' => $mahasiswa->get(),
                'soal' => $soal,
                'jawaban' => $jawaban
            ]
        );
    }
    public function create()
    {
        $screening = screening::all();

        return view(
            'admin.mahasiswa.screening.create',
            compact('screening')
        );
    }
    public function store(Request $request)
    {
        // dd($request);
        $screening = new screening();
        $screening->soal = $request->soal;
        $screening->kategori = $request->kategori;
        $screening->save();
        return redirect()->back();
    }
    public function destroy(screening $screening)
    {
        screening::destroy($screening->id);
        return redirect()->back();
    }
    public function screeningJawab(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'mahasiswa_id' => 'required|integer',
            'screening_id' => 'required|array',
            'screening_id.*' => 'integer',
            'jawaban' => 'required|array',
            'jawaban.*' => 'nullable|string',
            'keterangan' => 'required|array',
            'keterangan.*' => 'nullable|string',
        ]);

        $mahasiswaId = $data['mahasiswa_id'];
        $screeningIds = $data['screening_id'];
        $jawabans = $data['jawaban'];
        $keterangans = $data['keterangan'];

        foreach ($screeningIds as $index => $screeningId) {
            // Find the existing record if it exists
            $existingRecord = jawaban_screening::where('mahasiswa_id', $mahasiswaId)
                ->where('screening_id', $screeningId)
                ->first();

            if ($existingRecord) {
                // Update the existing record
                $existingRecord->update([
                    'jawaban' => $jawabans[$screeningId] ?? null,
                    'keterangan' => $keterangans[$screeningId] ?? null,
                ]);
            } else {
                // Create a new record
                jawaban_screening::create([
                    'mahasiswa_id' => $mahasiswaId,
                    'screening_id' => $screeningId,
                    'jawaban' => $jawabans[$screeningId] ?? null,
                    'keterangan' => $keterangans[$screeningId] ?? null,
                ]);
            }
        }

        return redirect()->back();


        
    }
}
