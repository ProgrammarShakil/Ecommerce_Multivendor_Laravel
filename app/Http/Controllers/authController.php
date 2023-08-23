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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password'))
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


    public function ImageUPload()
    {
        return view('imageUpload');
    }

    public function ImageUPloadProcess()
    {
        $validator = request()->validate([
            'photo' => 'required|image'
        ]);

        $file = request()->file('photo');
        if (request()->hasFile('photo')) {
            $fileName = uniqid('photo_') . "." .  $file->getClientOriginalExtension();
            $file->storeAs('images', $fileName);

            session()->flash('success', 'uploaded');
            return redirect()->back();
        }

        session()->flash('errorMsg',  'failed');
        return redirect()->back();
    }
}
