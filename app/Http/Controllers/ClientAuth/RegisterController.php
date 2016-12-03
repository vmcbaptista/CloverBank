<?php

namespace App\Http\Controllers\ClientAuth;

use App\Client;
use App\Mail\InactiveAccount;
use App\Mail\SendLoginInfo;
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
            'email' => 'required|email|unique:clients',
            'address' => 'required|max:255',
            'phone' => 'required|integer|min:200000000|max:999999999',
            'nif' => 'required|integer|min:100000000|max:999999999|unique:clients',
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

        // If the client is being inserted by the manager his account stays immediately active
        if (Auth::guard("manager")->check()) {
            $accountState = 1;
        }else{
            $accountState = 0;
        }

        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address'=>$data['address'],
            'phone'=>$data['phone'],
            'nif'=>$data['nif'],
            'accountState' => $accountState,
            'username'=> $username,
            'password' => bcrypt($password)
        ]);

    }

    /**
     * This method is used to register a client
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        event(new Registered($user));

        // If the client is created by the manager the client receives an email with his credentials
        // else he receives an e-mail confirming the request of the account
        if (Auth::guard("manager")->check()) {
            $password = str_random(8);
            $user->password = bcrypt($password);
            $user->save();
            Mail::to($request->email)->send(new SendLoginInfo($user->username,$password,$request->name));
            // Returns the id of the new client to associate it to an account
            return $user->id;
        } else {
            Mail::to($request->email)->send(new InactiveAccount($request->name));
            $askForAccount = true;
            return view('client.auth.register',compact('askForAccount'));
        }

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
