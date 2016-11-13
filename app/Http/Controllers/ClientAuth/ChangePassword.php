<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 07/11/16
 * Time: 14:31
 */

namespace App\Http\Controllers\ClientAuth;

use App\Client;
use App\Manager;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MudancaDePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class ChangePassword extends Controller
{

    use AuthenticatesUsers;


    function ApresentaForm()
    {

        $ErroVerificacao = 0;
        return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
    }

    public function passwordCheck()
    {

        $ErroVerificacao = 0;
        return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
    }

    public function VerificaDadosIntroduzidos()
    {
        $username= Auth::user()->username;
        $PasswordActual = $_REQUEST["PasswordAtual"];
        $NovaPassword = $_REQUEST['Newpassword'];
        $ConfirmNovaPassword = $_REQUEST['ConfirmNewpassword'];
        $ClientInfo = Client::where('username','=',$username)->first();

        if($PasswordActual !="" && $NovaPassword != "" && $ConfirmNovaPassword !="")
        {
            if($ClientInfo!=NULL)
            {
                if(Hash::check($PasswordActual, $ClientInfo->password))
                {
                    if($NovaPassword == $ConfirmNovaPassword )
                    {
                        Client::where('username','=',$username)->update(['password' => bcrypt($NovaPassword)]);
                        Mail::to($ClientInfo->email)->send(new MudancaDePassword($username,$NovaPassword,$ClientInfo->name));
                        Return redirect('client/home');
                    }
                    else
                    {
                        $ErroVerificacao = 4;
                        return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
                    }
                }
                else
                {
                    $ErroVerificacao = 3;
                    return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
                }

            }
            else
            {
                $ErroVerificacao = 2;
                return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
            }
        }
        else
        {
            $ErroVerificacao = 1;
            return view('/client/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
        }


    }

    protected function guard()
    {
        return Auth::guard('client');

    }
}

