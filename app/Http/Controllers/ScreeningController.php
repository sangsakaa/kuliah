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
    public function index(Request $request)
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
