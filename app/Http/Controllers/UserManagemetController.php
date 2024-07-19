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
        $AdminUser = User::latest();
        $data = Mahasiswa::all();
        if (request('cari')) {
            $AdminUser->where('name', 'like', '%' . request('cari') . '%');
        }

        return view('admin.pengguna.user', ([
            'AdminUser' => $AdminUser->get(), 'user' => $user,  'data' => $data
        ]));
    }
    public function CreateUserAdmin(Mahasiswa $mahasiswa)
    {
        $mahasiswas = Mahasiswa::all();

        $createdCount = 0; // Inisialisasi jumlah akun yang berhasil dibuat atau diperbarui

        foreach ($mahasiswas as $mahasiswa) {
            // Memeriksa apakah sudah ada akun dengan email tertentu
            $existingUser = User::where('email', $mahasiswa->nim . '@uniwa.ac.id')->first();

            if (!$existingUser) {
                // Jika belum ada, buat akun baru
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
            } else {
                // Jika email sudah ada, perbarui mahasiswa_id jika masih null
                if ($existingUser->mahasiswa_id === null) {
                    $existingUser->mahasiswa_id = $mahasiswa->id;
                    $existingUser->save();

                    // Pastikan role dan izin tetap ada jika diperlukan
                    $existingUser->assignRole('mahasiswa'); // Pastikan peran 'mahasiswa' sudah diberikan
                    $existingUser->givePermissionTo('create post'); // Memberikan izin 'create post' pada user
                    $existingUser->givePermissionTo('show post'); // Memberikan izin 'show post' pada user
                    $existingUser->givePermissionTo('edit post'); // Memberikan izin 'edit post' pada user

                    $createdCount++; // Menambahkan jumlah akun yang berhasil diperbarui
                }
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
            // Check if user already exists for the dosen
            $user = User::firstOrNew(['dosen_id' => $dosenData->id]);

            // Check if the email is unique
            if (!$user->exists && !User::where('email', $dosenData->nidn . '@uniwa.ac.id')->exists()) {
                $user->name = $dosenData->nama_dosen;
                $user->email = $dosenData->nidn . '@uniwa.ac.id';
                $user->password = Hash::make($dosenData->nidn);
                $user->dosen_id = $dosenData->id;
                $user->save();

                // Assign roles and permissions
                $user->assignRole('dosen');
                $user->givePermissionTo('create post');
                $user->givePermissionTo('show post');
                $user->givePermissionTo('edit post');
                $createdAccounts++;
            } elseif ($user->exists && $user->dosen_id === null) {
                // Update existing user record with null dosen_id
                $user->name = $dosenData->nama_dosen;
                $user->email = $dosenData->nidn . '@uniwa.ac.id';
                $user->password = Hash::make($dosenData->nidn);
                $user->dosen_id = $dosenData->id;
                $user->save();

                // Assign roles and permissions if not already assigned
                if (!$user->hasRole('dosen')) {
                    $user->assignRole('dosen');
                }
                if (!$user->hasPermissionTo('create post')) {
                    $user->givePermissionTo('create post');
                }
                if (!$user->hasPermissionTo('show post')) {
                    $user->givePermissionTo('show post');
                }
                if (!$user->hasPermissionTo('edit post')) {
                    $user->givePermissionTo('edit post');
                }
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
