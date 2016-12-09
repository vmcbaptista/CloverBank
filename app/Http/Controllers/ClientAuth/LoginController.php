<?php

namespace App\Http\Controllers\ClientAuth;

use App\Client;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        login as mainLogin;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/client/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client.guest', ['except' => 'logout']);
    }

    public function login(Request $request) {


        if (Auth::guard('manager')->check()) {
            return view('errors.access_denied_manager');
        }
        else if(Auth::guard('client')->attempt(['username'=>$request['username'], 'password'=> $request['password'],'accountState' => 1 ])){
            return $this->mainLogin($request);
        }
        else
        {
            //Add accountState Field from database
            $request->merge(array('accountState' => Client::where(['username' => $request['username']])->first()->accountState));
            return $this->mainLogin($request);
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('client');
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Redefinition of validator this way we will check if the account is active or inactive.
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {

        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'accountState' => Rule::unique('clients')->where(function($query){
                $query->where('accountState',0);
            })
        ]);
    }

}
