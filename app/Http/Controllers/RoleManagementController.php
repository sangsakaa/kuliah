<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Has_Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class RoleManagementController extends Controller
{
    public function roleManagement()
    {
        $dataRole = Role::all();
        
        return view(
            'admin.manajemen.role',
            [
                'roles' => $dataRole,

            ]
        );
    }
    public function HasRole()
    {

        $role = Role::all();
        $user = User::whereNotNull('dosen_id')->orderby('name')
            ->get();
        $dataHasRole = Has_Role::query()
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->select('users.name', 'model_id', 'role_id', 'roles.name as role_name');

        if (request('cari')) {
            $dataHasRole->where('users.name', 'like', '%' . request('cari') . '%');
        }

        $data = $dataHasRole->get();

        return view('admin.manajemen.has_role', [
            'role' => $role,
            'user' => $user,
            'dataHasRole' => $data,
        ]);


    }
    public function RemoveRole(Has_Role $has_Role)

    {
        try {
            // Run the delete query using the query builder
            DB::table('model_has_roles')
            ->where('role_id', $has_Role->role_id)
                ->where('model_type', 'App\Models\User')
                ->where('model_id', $has_Role->model_id)
                ->delete();

            // Flash a success message to the session
            Session::flash('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            // Flash an error message to the session
            Session::flash('error', 'An error occurred while deleting the role.');
        }

        return redirect()->back();
    }
    public function storeHasRole(Request $request)
    {
        $hasRole = new Has_Role();
        $hasRole->role_id = $request->role_id;
        $hasRole->model_type = $request->model_type;
        $hasRole->model_id = $request->model_id;
        $hasRole->save();
        // Show a success notification in the blade view
        Session::flash('success', 'Role and Model ID combination created successfully.');
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
