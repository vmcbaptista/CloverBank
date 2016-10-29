<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Session;


class LoginController extends Controller
{
    function VerifyLogin(Request $req)
    {
        //variaveis necessarias para a validacao
        $Username = $req['Username'];
        $Password = $req['Password'];
        $ErroLogin = 0;

        //Verfica se algum dos campos username e password estao vazios
        if($Username == "" || $Password =="")
        {
            $ErroLogin = 3;
            return view("LoginFailed")->with("ErrorLogin",$ErroLogin);
        }
        //informações da base de dados
        $userInfo = DB::table('current_account_has_client')->where('Username',$Username)->first();
        $ManagerInfo = DB::table('manager')->where('username',$Username)->first();

        //verificações do Login
        if($userInfo!=NULL)
        {
            //Verifica os dados do utilizador
            if(strcasecmp($Password, $userInfo->password) == 0)
            {
                //login bem sucedido
                //Login PaginaUtilizador
                session(['GrauAuth' => 1]);
                return redirect('/userpage');
            }
            else
            {
                $ErroLogin = 1;
                return view("LoginFailed")->with("ErrorLogin",$ErroLogin);
            }
        }
        else
        {
            //Verifica os dados do gestor
            if($ManagerInfo != NULL)
            {
                if(strcasecmp($Password, $ManagerInfo->password) == 0)
                {
                    //login bem sucedido
                    //Login PaginaGestor
                    session(['GrauAuth' => 2]);
                    return redirect('/managerpage');
                }
                else
                {
                    $ErroLogin = 1;
                    return view("LoginFailed")->with("ErrorLogin",$ErroLogin);
                }
            }
            else
            {
                //username nao existe na base de dados
                $ErroLogin = 2;
                return view("LoginFailed")->with("ErrorLogin",$ErroLogin);
            }
        }
    }

    function VerificaAutentificacaoUser()
    {

        if(session('GrauAuth') == 1)
        {
            return view("PaginaUtilizador");
        }
        else
        {
            return view("Login");
        }
    }
    function VerificaAutentificacaoGestor()
    {
        if(session('GrauAuth') == 2)
        {

            return view("PaginaGestor");
        }
        else
        {
            return view("Login");
        }
    }

    function EfetuaLogout()
    {
        session(['GrauAuth' => 0]);
        return redirect('/Login');
    }
}
