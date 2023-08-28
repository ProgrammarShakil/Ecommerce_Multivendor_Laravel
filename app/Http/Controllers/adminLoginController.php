<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminLoginController extends Controller
{
    public function adminLoginForm()
    {
        return view('admin_login.login_form');
    }

    public function adminLogin()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = request()->except('_token');

        if (auth()->guard('admin')->attempt($credentials)){

            return redirect()->route('admin_dashboard.index')->with('successAdminLogin', 'Login Successfully');
        }else{
            return redirect()->back()->with('errorCredentials', 'Credentials Don\'t Match');
        }
    }

    public function adminLogOut(){
        auth()->guard('admin')->logout();
        return redirect()->route('frontend.index')->with('adminLogout', 'Admin Logout Successfully');
    }
}
