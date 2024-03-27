<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::all();

        return view('admin.periode.semester', compact('semester'));
    }
    public function StoreSemester(Request $request)
    {
        $semester = new Semester();
        $semester->semester = $request->semester;
        $semester->nama_semester = $request->nama_semester;
        $semester->save();
        return redirect()->back();
    }
    public function indexPeriode()
    {
        $semester = Semester::all();
        $periode_semester = Periode::join('semester', 'semester.id', 'periode.semester_id')->select('nama_semester', 'nama_periode')->get();
        return view('admin.periode.periode', compact('semester', 'periode_semester'));
    }
    public function StorePeriode(Request $request)
    {
        // dd('ok');
        // $semester = Semester::latest()->first();
        $semester = new Periode();
        $semester->semester_id = $request->semester_id;
        $semester->nama_periode = $request->nama_periode;
        $semester->save();
        return redirect()->back();
    }
}
