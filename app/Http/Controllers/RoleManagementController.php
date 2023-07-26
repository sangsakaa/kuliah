<?php

namespace App\Http\Controllers;

use App\Models\Has_Role;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class RoleManagementController extends Controller
{
    public function roleManagement()
    {
        $dataRole = Role::all();
        return view(
            'admin.manajemen.role',
            ['roles' => $dataRole]
        );
    }
    public function HasRole()
    {

        $role = Role::all();
        $user = User::whereNotNull('dosen_id')->orderby('name')
            ->get();

        return view(
            'admin.manajemen.has_role',
            compact(['role', 'user'])

        );
    }
    public function storeHasRole(Request $request)
    {

        $existingRecord = Has_Role::where('role_id', $request->role_id)
            ->where('model_type', $request->model_type)
            ->where('model_id', $request->model_id)
            ->first();

        if ($existingRecord) {
            // Record already exists, show a notification in the blade view
            Session::flash('error', 'Role and Model ID combination already exists.');
        } else {
            // Record doesn't exist, create a new one
            $hasRole = new Has_Role();
            $hasRole->role_id = $request->role_id;
            $hasRole->model_type = $request->model_type;
            $hasRole->model_id = $request->model_id;
            $hasRole->save();

            // Show a success notification in the blade view
            Session::flash('success', 'Role and Model ID combination created successfully.');
        }

        return redirect()->back();
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'wajib ada isinya'
            ]
        );


        $dataRole = Role::all();
        $existingRole = Role::where('name', $request->name)->first();

        if ($existingRole) {
            // Role dengan nama yang sama sudah ada
            Session::flash('message', 'Role dengan nama tersebut sudah ada!');
            Session::flash('alert-class', 'alert-danger');

            // Redirect kembali ke halaman sebelumnya atau halaman tertentu
            return redirect()->back(); // atau return redirect()->route('nama_rute');
        } else {
            // Role dengan nama yang sama belum ada, maka simpan data baru
            $role = new Role();
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $role->save();

            // Set notifikasi sukses jika diperlukan
            Session::flash('message', 'Role berhasil disimpan!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->back(); // Ganti "nama_rute" dengan nama rute yang sesuai
        }
    }
}
