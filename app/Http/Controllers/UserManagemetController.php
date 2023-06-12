<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Hash;

class UserManagemetController extends Controller
{
    public function UserAdmin(User $user)
    {
        $AdminUser = User::paginate(20);
        $data = Mahasiswa::all();

        return view('admin.pengguna.user', compact('AdminUser', 'user',  'data'));
    }
    public function CreateUserAdmin(Mahasiswa $mahasiswa)
    {
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            $user = new User();
            $user->name = $mahasiswa->nama_mhs;
            $user->email = $mahasiswa->nim . '@uniwa.ac.id';
            $user->password = Hash::make($mahasiswa->nim);
            $user->mahasiswa_id = $mahasiswa->id;
            $user->save();
            $user->assignRole('mahasiswa'); // Memberikan peran 'mahasiswa' pada user
            $user->givePermissionTo('create post'); // Memberikan izin 'create post' pada user
            $user->givePermissionTo('show post'); // Memberikan izin 'show post' pada user
            $user->givePermissionTo('edit post'); // Memberikan izin 'edit post' pada user
        }

        return redirect()->back();
    }
    public function CreateUserDosen(Dosen $dosen)
    {
        $dosen = Dosen::all();

        foreach ($dosen as $dosen) {
            $user = new User();
            $user->name = $dosen->nama_dosen;
            $user->email = $dosen->nidn . '@uniwa.ac.id';
            $user->password = Hash::make($dosen->nidn);
            $user->dosen_id = $dosen->id;
            $user->save();
            $user->assignRole('dosen'); // Memberikan peran 'mahasiswa' pada user
            $user->givePermissionTo('create post'); // Memberikan izin 'create post' pada user
            $user->givePermissionTo('show post'); // Memberikan izin 'show post' pada user
            $user->givePermissionTo('edit post'); // Memberikan izin 'edit post' pada user
        }

        return redirect()->back();
    }
}
