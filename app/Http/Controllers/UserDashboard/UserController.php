<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['users'] = User::get();
        return view('user_dashboard.pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('user_dashboard.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $user = new User();
            $user->name = request('name');
            $user->email = request('name');
            $user->password = request('name');
            $user->email_verification_token = Str::random(32);
            $user->last_login = Carbon::now();

            if (request('roles')) {
                $user->assignRole(request('roles'));
            }

            $user->save();

            return redirect()->route('user_dashboard.user.index')->with('successMessage', 'User Created Successfully')->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('successMessage', $e->getMessage());
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
        $roles = Role::all();
        $user = User::find($id);
        return view('user_dashboard.pages.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'old_password' => 'nullable',
        ]);

        $old_password = request('old_password');
        $single_user = Auth::user();

        if ($old_password && (!Hash::check($old_password, $single_user->password))) {
            return redirect()->back()->with('errorMessage', 'The old password is incorrect.');
        } else {
            try {
                $user = User::find($id);
                $user->name = request('name');
                $user->email = request('email');
                $user->password = bcrypt('password');
                $user->update();

                $user->roles()->detach();

                if(request('roles')){
                    $user->assignRole(request('roles'));
                }

                return redirect()->route('user_dashboard.user.index')->with('successMessage', 'User Updated Successfully');
            } catch (Exception $e) {
                return redirect()->back()->with('errorMessage', $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $user = User::find($id);

        try {
            $user->roles()->detach();
            $user->delete();
            return redirect()->back()->with('successMessage', 'User Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errorMessage', $e->getMessage());
        }
    }
}
