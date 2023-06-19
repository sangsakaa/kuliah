<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $UserPermhs = Auth::user()->mahasiswa_id;
        $UserPerDosen = Auth::user()->dosen_id;
        $data = Mahasiswa::where('id', $UserPermhs)->get();
        $dataDosen = Dosen::where('id', $UserPerDosen)->get();
        $putra = Mahasiswa::where('jenis_kelamin', 'L')->count();
        $putri = Mahasiswa::where('jenis_kelamin', 'P')->count();
        return view('/dashboard', compact('putra', 'putri', 'data', 'dataDosen'));
    }
}