<?php

namespace App\Http\Controllers;

use App\Models\file_screening;
use Dompdf\Dompdf;
use App\Models\Mahasiswa;
use App\Models\screening;
use Illuminate\Http\Request;
use App\Models\jawaban_screening;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
class ScreeningController extends Controller
{
    public function index()
    {
        $dataScreening = jawaban_screening::query()
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'jawaban_screening.mahasiswa_id')
            ->leftjoin('file_screening', 'file_screening.mahasiswa_id', 'jawaban_screening.mahasiswa_id')
            ->select([
                'mahasiswa.nama_mhs',
                'jawaban_screening.mahasiswa_id',
                'jawaban_screening.jawaban',
                'prodi',
                'nim', 'file', 'status_file', 'file_screening.id as idfile'
        ])
            ->whereNot('status_file', 'Valid')
            ->orWhereNull('status_file')
            ->orderByRaw('CASE WHEN file IS NULL THEN 1 ELSE 0 END, file DESC')
        ->get();
        // Mengelompokkan data berdasarkan mahasiswa_id
        $groupedData = $dataScreening  
        ->groupBy('mahasiswa_id');
        $jumlahTotalList = $groupedData->count();
        $jumlahTotal = jawaban_screening::query()
            ->leftjoin('file_screening', 'file_screening.mahasiswa_id', 'jawaban_screening.mahasiswa_id')
            // ->where('status_file', 'valid')
            ->distinct('jawaban_screening.mahasiswa_id')
            ->count('jawaban_screening.mahasiswa_id');
        $jumlahTotalValid = jawaban_screening::query()
        ->leftjoin('file_screening', 'file_screening.mahasiswa_id', 'jawaban_screening.mahasiswa_id')
        ->where('status_file', 'valid')
        ->distinct('jawaban_screening.mahasiswa_id')
        ->count('jawaban_screening.mahasiswa_id');
        // dd($groupedData);
        // Menghitung jumlah mahasiswa berdasarkan prodi
        $countProdi = $dataScreening->groupBy('prodi')->map(function ($items, $key) {
            $mahasiswaIdCount = $items->unique('mahasiswa_id')->count();
            
            return [
                'unique_mahasiswa_id' => $mahasiswaIdCount
            ];
        });
        return view(
            'admin.mahasiswa.screening.index',
            compact('dataScreening', 'groupedData', 'countProdi', 'jumlahTotal', 'jumlahTotalValid', 'jumlahTotalList')

        );
    }
    public function destroy_screening($mahasiswa_id)
    {
        jawaban_screening::where('mahasiswa_id', $mahasiswa_id)->delete();
        $screenings = file_screening::where('mahasiswa_id', $mahasiswa_id)->get();

        foreach ($screenings as $screening) {
            // dd($screening);
            // Hapus file dari folder public/screenings
            Storage::delete('public/screenings/' . $screening->file);
            // Hapus record dari database
            $screening->delete();
        }
        return redirect()->back();
    }
    public function view_pdf($nim)
    {
        $soal = screening::query()
            // ->rightjoin('jawaban_screening', 'jawaban_screening.screening_id', 'screening.id')
            // ->select('screening.id', 'jawaban', 'soal ')
            ->get();
        $mahasiswa = Mahasiswa::where('nim', $nim);
        $jawaban = jawaban_screening::query()
            ->join('mahasiswa', 'mahasiswa.id', 'jawaban_screening.mahasiswa_id')
            ->join('screening', 'jawaban_screening.screening_id', 'screening.id')
            ->where('mahasiswa.nim', $nim)
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
            'admin.mahasiswa.screening.view_pdf',
            [
                'mahasiswa' => $mahasiswa->get(),
                'soal' => $soal,
                'jawaban' => $jawaban
            ]
        );
    }


    public function download_pdf($nim)
    {

        $dompdf = new Dompdf();
        $soal = screening::query()
            // ->rightjoin('jawaban_screening', 'jawaban_screening.screening_id', 'screening.id')
            // ->select('screening.id', 'jawaban', 'soal ')
            ->get();
        $mahasiswa = Mahasiswa::where('nim', $nim);
        $jawaban = jawaban_screening::query()
            ->join('mahasiswa', 'mahasiswa.id', 'jawaban_screening.mahasiswa_id')
            ->join('screening', 'jawaban_screening.screening_id', 'screening.id')
            ->where('mahasiswa.nim', $nim)
            // ->select('nim')
            // ->where('nim', 20205110109)
            ->get()
            ->mapWithKeys(function ($jawaban,) {
                return [
                    $jawaban->screening_id => $jawaban
                ];
            });
        $html = view(
            'admin.mahasiswa.screening.view_pdf',
            [
                'mahasiswa' => $mahasiswa->get(),
                'soal' => $soal,
                'jawaban' => $jawaban
            ]
        )->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        // $dompdf->setPaper('legal', 'portrait');

        $dompdf->render();
        $dompdf->stream($nim . ' - ' . $mahasiswa->first()->nama_mhs . '.pdf', ['Attachment' => true]);
        
    }
    public function screening(Request $request)
    {
        // dd($request);
        $dataScreening = file_screening::query()
            ->join('mahasiswa', 'file_screening.mahasiswa_id', 'mahasiswa.id')
            ->where('mahasiswa.nim', request('cari'))
            ->get();
        $soal = screening::query()
            // ->rightjoin('jawaban_screening', 'jawaban_screening.screening_id', 'screening.id')
            // ->select('screening.id', 'jawaban', 'soal ')
            ->get();
        $mahasiswa = Mahasiswa::query();
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
                'jawaban' => $jawaban,
                'dataScreening' => $dataScreening
               
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
    public function uploudFile(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'file' => 'required|file|max:10240',
        ]);
        

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // dd($request);
            // Dapatkan nama file asli
            $fileName = $file->getClientOriginalName();

            // Tambahkan timestamp untuk memastikan nama file unik
            $timestamp = time();
            $fileName = $fileName;

            // Simpan file ke dalam direktori 'screenings' di dalam folder penyimpanan default
            $file->storeAs('screenings', $fileName, 'public');

            // Periksa apakah ada entri yang sudah ada dalam database
            $existingEntry = file_screening::where('mahasiswa_id', $request->mahasiswa_id)->first();

            if ($existingEntry) {
                // Jika entri sudah ada, perbarui dengan data baru
                $existingEntry->file = $fileName;
                $existingEntry->save();

                return redirect()->back()->with('success', 'File berhasil diperbarui.');
            } else {
                // Jika tidak ada entri, buat entri baru
                $screening = new file_screening(); // Pastikan Anda mengganti namespace dengan namespace yang benar
                $screening->mahasiswa_id = $request->mahasiswa_id;
                $screening->file = $fileName;
                $screening->save();

                return redirect()->back()->with('success', 'File berhasil diunggah.');
            }
        } else {
            // Tindakan jika tidak ada file yang diunggah
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }
    }
    public function ValidasiScreening()
    {
        $dataScreening = file_screening::query()
            ->join('mahasiswa', 'file_screening.mahasiswa_id', 'mahasiswa.id')
            ->select('file_screening.file', 'file_screening.id', 'prodi', 'nama_mhs', 'status_file', 'nim')
            ->get();
        return view(
            'admin.mahasiswa.screening.validasi_screening',
            compact('dataScreening')

        );
    }
    public function UpdateStatusScreening(file_screening $file_screenig)
    {
        return view(
            'admin.mahasiswa.screening.update_validasi_screening',
            compact('file_screenig')

        );
    }
    public function uploudFileStatus(file_screening $file_screenig, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'file' => 'required|string',
            'status_file' => 'required|string',
        ]);
        // Temukan record yang akan di-update
        $fileScreening = file_screening::findOrFail($file_screenig->id);
        // Update data
        $fileScreening->update([
            'mahasiswa_id' => $file_screenig->mahasiswa_id,
            'file' => $file_screenig->file,
            'status_file' => $request->input('status_file'),
        ]);
        return redirect('/daftar-screening-mahasiswa');
    }
    public function HapusFile(file_screening $file_screenig)
    {

        // dd($file_screenig);
        $screenings = file_screening::where('mahasiswa_id', $file_screenig->mahasiswa_id)->get();
        foreach ($screenings as $screening) {
            // dd($screening);
            // Hapus file dari folder public/screenings
            Storage::delete('public/screenings/' . $screening->file);
            // Hapus record dari database
            $screening->delete();
        }
        return redirect()->back();
    }
    public function LaporanPDF()
    {
        $dataScreening = jawaban_screening::query()
            ->leftjoin('mahasiswa', 'mahasiswa.id', '=', 'jawaban_screening.mahasiswa_id')
            ->leftjoin('file_screening', 'file_screening.mahasiswa_id', 'jawaban_screening.mahasiswa_id')
            ->select([
                'mahasiswa.nama_mhs',
                'jawaban_screening.mahasiswa_id',
                'jawaban_screening.jawaban',
                'prodi',
                'nim', 'file', 'status_file', 'file_screening.id as idfile'
            ])
            ->whereNot('status_file', 'Valid')
            ->orWhereNull('status_file')
            ->orderByRaw('CASE WHEN file IS NULL THEN 1 ELSE 0 END, file DESC')
            ->get();
        // Mengelompokkan data berdasarkan mahasiswa_id
        $groupedData = $dataScreening
        ->groupBy('mahasiswa_id');
        return view('admin.mahasiswa.screening.laporan', compact('groupedData'));
    }
    
}
