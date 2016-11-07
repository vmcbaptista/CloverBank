<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 07/11/16
 * Time: 14:31
 */

namespace App\Http\Controllers\ManagerAuth;

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
        return view('/manager/auth/passwords/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
    }

    function VerificaDadosIntroduzidos()
    {

        $username= $_REQUEST["username"];
        $PasswordActual = $_REQUEST["PasswordAtual"];
        $NovaPassword = $_REQUEST['Newpassword'];
        $ConfirmNovaPassword = $_REQUEST['ConfirmNewpassword'];
        $ManagerInfo = Manager::where('username','=',$username)->first();

        if($username !="" && $PasswordActual !="" && $NovaPassword != "" && $ConfirmNovaPassword !="")
        {
            if($ManagerInfo!=NULL)
            {
                if(Hash::check($PasswordActual, $ManagerInfo->password))
                {
                    if($NovaPassword == $ConfirmNovaPassword )
                    {
                        Manager::where('username','=',$username)->update(['password' => bcrypt($NovaPassword)]);
                        Mail::to($ManagerInfo->email)->send(new MudancaDePassword($username,$NovaPassword,$ManagerInfo->name));
                        Return view('/manager/home');
                    }
                    else
                    {
                        $ErroVerificacao = 4;
                        return view('/manager/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
                    }
                }
                else
                {
                    $ErroVerificacao = 3;
                    return view('/manager/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
                }

            }
            else
            {
                $ErroVerificacao = 2;
                return view('/manager/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
            }
        }
        else
        {
            $ErroVerificacao = 1;
            return view('/manager/ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
        }


    }

    protected function guard()
    {
        return Auth::guard('manager');
    }
}

