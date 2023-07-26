<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Hash;

class UserManagemetController extends Controller
{
    public function UserAdmin(User $user)
    {
        $AdminUser = User::paginate(10);
        $data = Mahasiswa::all();

        return view('admin.pengguna.user', compact('AdminUser', 'user',  'data'));
    }
    public function CreateUserAdmin(Mahasiswa $mahasiswa)
    {
        $mahasiswas = Mahasiswa::all();

        $createdCount = 0; // Inisialisasi jumlah akun yang berhasil dibuat

        foreach ($mahasiswas as $mahasiswa) {
            // Memeriksa apakah sudah ada akun dengan mahasiswa_id tertentu
            $existingUser = User::where('mahasiswa_id', $mahasiswa->id)->first();

            if (!$existingUser) {
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

                $createdCount++; // Menambahkan jumlah akun yang berhasil dibuat
            }
        }

        // Notifikasi jumlah akun yang berhasil dibuat
        if ($createdCount > 0) {
            Session::flash('success', "Berhasil membuat $createdCount akun.");
        } else {
            Session::flash('info', "Semua mahasiswa sudah memiliki akun.");
        }


        return redirect()->back();
    }
    public function CreateUserDosen(Dosen $dosen)
    {
        $dosen = Dosen::all();
        $createdAccounts = 0;

        foreach ($dosen as $dosenData) {
            $user = User::firstOrCreate([
                'dosen_id' => $dosenData->id,
            ], [
                'name' => $dosenData->nama_dosen,
                'email' => $dosenData->nidn . '@uniwa.ac.id',
                'password' => Hash::make($dosenData->nidn),
            ]);

            if ($user->wasRecentlyCreated) {
                // The user was just created, assign roles and permissions
                $user->assignRole('dosen');
                $user->givePermissionTo('create post');
                $user->givePermissionTo('show post');
                $user->givePermissionTo('edit post');
                $createdAccounts++;
            }
        }

        // Display the notification
        if ($createdAccounts > 0) {
            echo $createdAccounts . ' akun telah berhasil dibuat.';
        } else {
            echo 'Tidak ada akun baru yang dibuat.';
        }


        return redirect()->back();
    }
}
