<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;


class DosenController extends Controller
{

    private $token = null;
    private function getToken()
    {
        $response = Http::post(env('feeder_url'), [
            'act' => 'GetToken',
            'username' => env('PDDIKTI_USERNAME'),
            'password' => env('PDDIKTI_PASSWORD')
        ]);
        $this->token = $response['data']['token'];
        return $response;
    }
    public function SingkronDosen()
    {
        try {
            $lisDosen = $this->GetListDosen();
        } catch (ConnectionException $ex) {
            return  redirect()->back()->with('error', 'tidak terhubung dengan server');
        }
        // dd($lisDosen);


        $mapToDosen = function ($data) {
            return [
                'nidn' => $data['nidn'],
                'nama_dosen' => $data['nama_dosen'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'nama_agama' => $data['nama_agama'],
                'nama_status_aktif' => $data['nama_status_aktif'],
            ];
        };

        $existingNidns = Dosen::pluck('nidn')->toArray(); // mendapatkan array semua nidn yang sudah ada di database
        $lisDosen = array_filter($lisDosen, function ($data) use ($existingNidns) {
            return !in_array($data['nidn'], $existingNidns); // hanya mempertahankan data yang memiliki nidn yang belum ada di database
        });

        $lisDosen = array_map($mapToDosen, $lisDosen);
        Dosen::upsert($lisDosen, ['nidn']);

        return redirect('data-Dosen')->with('success', 'Data Behasil di singkronisasi');
    }
    private function GetListDosen()
    {
        if (!$this->token) $this->getToken();
        $response = Http::post(env('feeder_url'), [
            'act' => 'GetListDosen',
            'token' => $this->token,
            'filter' => "",
            'order' =>  '',
            'limit' => 0
        ]);
        $hapusNimNull = function ($data) {
            return $data['nidn'] != null;
        };
        return array_filter($response['data'], $hapusNimNull);
    }
    public function dataDosen()
    {

        $listDosen = Dosen::orderBy('nama_dosen')
            ->where('nidn', 'LIKE', '07%')
            ->where('nama_status_aktif', 'aktif');
        if (request('cari')) {
            $listDosen->where('nama_dosen', 'like', '%' . request('cari') . '%')->orderBy('nama_dosen');
        }

        $jenis_kelamin = Dosen::select(DB::raw('jenis_kelamin, count(*) as count'))
            ->where('nidn', 'LIKE', '07%')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('count', 'jenis_kelamin')
            ->toArray();
        $totalDosen = Dosen::where('nidn', 'LIKE', '07%')
            ->count();
        return view(
            'admin.dosen.dosen',
            [
                'listDosen' => $listDosen->paginate(),
                'jenis_kelamin' => $jenis_kelamin,
                'totalDosen' => $totalDosen


            ]
        );
    }
    public function Destroy(Dosen $dosen)
    {
        Dosen::destroy('id', $dosen->id);
        return redirect()->back();
    }
}
