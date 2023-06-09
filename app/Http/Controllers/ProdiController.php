<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class ProdiController extends Controller
{
    private $token = null;
    private function getToken()
    {
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetToken',
            'username' => env('PDDIKTI_USERNAME'),
            'password' => env('PDDIKTI_PASSWORD')
        ]);
        $this->token = $response['data']['token'];
        return $response;
    }

    public function index()
    {
        try {
            $data = $this->getMahasiswa();
        } catch (ConnectionException $ex) {
            return view('setting', ['listMahasiswa' => [], 'total' => 0])->with('error', 'tidak terhubung dengan server');
        }


        $total = count($data);
        dd($total);
        return $total;
    }
    public function SingkronProdi()
    {
        try {
            $lisDosen = $this->GetProdi();
        } catch (ConnectionException $ex) {
            return  redirect()->back()->with('error', 'tidak terhubung dengan server');
        }
        // dd($lisDosen);

        $mapToDosen = function ($data) {
            return [

                'kode_program_studi' => $data['kode_program_studi'],
                'nama_program_studi' => $data['nama_program_studi'],
                'status' => $data['status'],
                'nama_jenjang_pendidikan' => $data['nama_jenjang_pendidikan'],
            ];
        };
        $lisDosen = array_map($mapToDosen, $lisDosen);
        Prodi::upsert($lisDosen, ['kode_program_studi']);
        return  redirect()->back();
    }
    private function GetProdi()
    {
        if (!$this->token) $this->getToken();
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetProdi',
            'token' => $this->token,
            'filter' => "",
            'order' =>  '',
            'limit' => 0
        ]);
        $hapusNimNull = function ($data) {
            return $data['kode_program_studi'] != null;
        };
        return array_filter($response['data'], $hapusNimNull);
    }
    public function dataProdi()
    {
        $listMahasiswa = Prodi::orderBy('nama_program_studi');
        return view(
            'admin.prodi.prodi',
            [
                'listMahasiswa' => $listMahasiswa->get(),

            ]
        );
    }
}
