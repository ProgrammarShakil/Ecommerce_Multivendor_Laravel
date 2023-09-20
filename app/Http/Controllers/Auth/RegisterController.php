<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserVerificationEmail;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\NotifyInactiveUsers;
use App\Notifications\NotifyUser;
use App\Notifications\NotifyWithDB;
use App\Notifications\NotifyWithSMS;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verification_token' => Str::random(32),
            'last_login' => Carbon::now(),
        ]);

        // Mail::to($user->email)->queue(new UserVerificationEmail($user));

        // $user->notify(new NotifyUser($user));

        // $user->notify(new NotifyWithSMS());

        $basic  = new \Vonage\Client\Credentials\Basic("68262852", "if9i1d1Py8P7BAnK");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("8801770345518", 'Netigian IT', 'Successfully Registered.')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

        $admin = Admin::find(1);

        $admin->notify(new NotifyWithDB($user));

        session()->flash('message', 'Registration Success, Check Email To Verify Your Account');

        return $user;
    }
}
