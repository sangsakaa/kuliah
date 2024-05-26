<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index(Request $request)
    {

        $mahasiswa = Mahasiswa::query();

        if (request('cari') !== null) {
            $mahasiswa->where('nim', '=', request('cari'));
        }

        return view(
            'admin.mahasiswa.screening.screening',
            [
                'mahasiswa' => $mahasiswa->get(),
            ]
        );
    }
}
