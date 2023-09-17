<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['roles'] = Role::get();
        return view('user_dashboard.pages.role_permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['permissions'] = Permission::get();
        $data['permission_group'] = User::getPermissionGroups();
        return view('user_dashboard.pages.role_permission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'role_name' => 'required|unique:roles,id',
            'permissions' => 'required'
        ]);

        // get role name
        $data = [
            'name' => request('role_name'),
        ];

        //get permission data
        $permissions = request('permissions');

        try {
            //role create
            $role = Role::create($data);

            //if permission not blank, assign role
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            return redirect()->route('user_dashboard.role_permission.index')->with('successMessage', 'Role Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errorMessage', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
