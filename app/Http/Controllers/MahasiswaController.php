<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

use App\Exports\MahasiswaExport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Client\ConnectionException;



class MahasiswaController extends Controller
{
    private $token = null;
    public function index()
    {
        try {
            $data = $this->getMahasiswa();
        } catch (ConnectionException $ex) {
            return view('setting', ['listMahasiswa' => [], 'total' => 0])->with('error', 'tidak terhubung dengan server');
        }


        $total = count($data);
        // dd($data);
        return view('setting', ['listMahasiswa' => $data, 'total' => $total]);
    }
    public function deteksiDuplikasi()
    {
        try {
            if (!$this->token) $this->getToken();
            $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
                'act' => 'GetListMahasiswa',
                'token' => $this->token,
                'filter' => "nama_status_mahasiswa = 'AKTIF'",
                'order' =>  'nim',
                'limit' => 0
            ]);
        } catch (ConnectionException $ex) {
            return 'server error';
        }
        $hapusNimNull = function ($data) {
            return $data['nim'] != null;
        };
        $data = array_filter($response['data'], $hapusNimNull);
        $nimSebelumnya = '';
        for ($idx = 0; $idx < count($data); $idx++) {
            if ($idx == 0) {
                $data[$idx]['nim-ganda'] = false;
            } else {
                $data[$idx]['nim-ganda'] = $nimSebelumnya == $data[$idx]['nim'];
            }
            $nimSebelumnya = $data[$idx]['nim'];
        }
        $total = count($data);
        return view('mahasiswa-deteksi', ['listMahasiswa' => $data, 'total' => $total]);
    }
    private function getToken()
    {
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetToken',
            'username' => env('PDDIKTI_USERNAME'),
            'password' => env('PDDIKTI_PASSWORD')
        ]);
        $this->token = $response['data']['token'];
    }
    public function sinkronisasi()
    {
        try {
            $lisMahasiswa = $this->getMahasiswa();
        } catch (ConnectionException $ex) {
            return  redirect()->back()->with('error', 'tidak terhubung dengan server');
        }

        $mapToMahasiswa = function ($data) {
            return [
                'nim' => $data['nim'],
                'nama_mhs' => $data['nama_mahasiswa'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                
                'tgl_lahir' => substr($data['tanggal_lahir'], 6) . '-' . substr($data['tanggal_lahir'], 3, 2) . '-' . substr($data['tanggal_lahir'], 0, 2), // '12-04-2000'
                'agama' => $data['nama_agama'],
                'prodi' => $data['nama_program_studi'],
                'status' => $data['nama_status_mahasiswa'],
                'periode_masuk' => $data['id_periode'],
                
            ];
        };
        $lisMahasiswa = array_map($mapToMahasiswa, $lisMahasiswa);
        Mahasiswa::upsert($lisMahasiswa, ['nim'], ['status']);
        return  redirect()->back();
    }
    private function getMahasiswa()
    {
        if (!$this->token) $this->getToken();
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetListMahasiswa',
            'token' => $this->token,
            'filter' => "nama_status_mahasiswa = 'AKTIF'",
            'order' =>  'nama_program_studi,id_periode,nama_mahasiswa',
            'limit' => 0
        ]);
        $hapusNimNull = function ($data) {
            return $data['nim'] != null;
        };
        return array_filter($response['data'], $hapusNimNull);
    }
    public function dataMahahsiswa()
    {
        $cari = Mahasiswa::orderBy('periode_masuk');
        
        if (request('cari')) {
            $cari->where(function ($query) {
                $query->where('nama_mhs', 'like', '%' . request('cari') . '%')
                    ->orWhere('prodi', 'like', '%' . request('cari') . '%');
            })
            ->orderby('periode_masuk');
        }
        $results = $cari->paginate(100);

        $total = Mahasiswa::count();
        $listMahasiswa = Mahasiswa::all();
        $lulus = Mahasiswa::where('status', 'Aktif')->count();
        $putra = Mahasiswa::where('jenis_kelamin', 'L')->count();
        $putri = Mahasiswa::where('jenis_kelamin', 'P')->count();
        $prodi = Mahasiswa::where('periode_masuk', '20191')->count();
        return view('mahasiswa', ['lulus' => $lulus, 'total' => $total, 'listMahasiswa' => $listMahasiswa, 'putra' => $putra, 'putri' => $putri, 'prodi' => $prodi, 'listMahasiswa' => $results]);
    }
    public function exportExcel()
    {
        $data = Mahasiswa::where('status', 'aktif')->get()->toArray();
        // dd($data);
        return Excel::download(new MahasiswaExport($data), 'mahasiswa.xlsx');
    }
}
