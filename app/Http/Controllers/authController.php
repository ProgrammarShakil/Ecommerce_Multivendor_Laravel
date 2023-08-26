<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function LoginForm()
    {
        return view('login');
    }

    public function ProcessLogin()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = request()->except('_token');

        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }

        session()->flash('message', 'auth failed');
        redirect('/');
    }

    public function RegisterForm()
    {
        return view('register');
    }

    public function ProcessRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|min:10||unique:users,phone',
            'password' => 'required|min:2|max:15|confirmed',
            'photo' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = request()->file('photo');
        if ($file->isValid()) {
            $fileName = uniqid('photo_') . "." .  $file->getClientOriginalExtension();
            $file->storeAs('images', $fileName);
        }

        $data = [
            'name' => strtolower(trim($request->input('name'))),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'photo' => $file,
        ];

        try {
            User::create($data);

            session()->flash('message', 'User Account Created');
            return redirect()->back();
        } catch (Exception $e) {

            session()->flash('message' . $e->getMessage());
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

}
