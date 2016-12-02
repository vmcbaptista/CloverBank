<?php

namespace App\Http\Controllers\ClientAuth;

use App\Client;
use App\Mail\InactiveAccount;
use Illuminate\Auth\Events\Registered;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/client/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client.guest');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:clients',
            //'password' => 'required|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Client
     */
    protected function create(array $data)
    {
        $username = explode(" ",$data['name']);
        $username = end($username)[0];
        $username .= substr($data['name'],0,2);
        $username .= $data['nif'];
        $nomeClient = $data['name'];
        $password = str_random(8);
        $mail = $data['email'];


        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address'=>$data['address'],
            'phone'=>$data['phone'],
            'nif'=>$data['nif'],
            'accountState' => 0,
            'username'=> $username,
            'password' => bcrypt($password)
        ]);

    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($request->email)->send(new InactiveAccount($request->name));

        $askForAccount = true;
        return view('client.auth.register',compact('askForAccount'));
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $askForAccount = false;
        return view('client.auth.register',compact("askForAccount"));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('client');
    }
}
