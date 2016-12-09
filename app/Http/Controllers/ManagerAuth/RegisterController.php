<?php

namespace App\Http\Controllers\ManagerAuth;

use App\Manager;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLoginInfo;

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
    protected $redirectTo = '/manager/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('manager.guest');
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
            'email' => 'required|email|max:255|unique:managers',
            'phone' => 'required|min:9|max:9',
            'nif' => 'required|min:9|max:9'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Manager
     */
    protected function create(array $data)
    {
        $nomeUsername = substr($data['name'],0,2);
        $nomeusername2 = "G_".$nomeUsername.$data['nif'];
        $nomeManager = $data['name'];
        $password = str_random(8);
        $mail = $data['email'];

        Mail::to($mail)->send(new SendLoginInfo($nomeusername2,$password,$nomeManager));
        return Manager::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'nif'=>$data['nif'],
            'username'=> $nomeusername2,
            'password' => bcrypt($password)
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('manager.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('manager');
    }
}
