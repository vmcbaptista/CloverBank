<?php

namespace App\Http\Controllers\ManagerAuth;

use App\Mail\ResetPasswordCode;
use App\Manager;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\MudancaDePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ForgotPasswordController extends Controller
{


    function ForgotPasswordForm()
    {
        $VerificationStep=0;
        $Erroverification=0;
        return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
    }

    function CheckEmail()
    {
        $managerMail = $_REQUEST['EmailManager'];
        $ManagerInfo = Manager::where('email','=',$managerMail)->first();

        if($managerMail == "")
        {
            $VerificationStep=0;
            $Erroverification=1; // Nao pode existir campos vazios
            return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
        if($ManagerInfo != NULL)
        {
            $VerificationStep=1;
            $Erroverification=0;
            $VerificationCode = str_random(4);
            session()->put('VerificationCode',$VerificationCode);
            session()->put('ManagerMail',$managerMail);

            Mail::to($managerMail)->send(new ResetPasswordCode($VerificationCode,$ManagerInfo->name));
            return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
        else
        {
            $VerificationStep=0;
            $Erroverification=2; // nao existe nenhuma conta com esse email associado
            return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
    }

    function CheckVerificationCode()
    {

       $VerificationCode=session()->get('VerificationCode');
       $managerVerificationCode = $_REQUEST['verificationCode'];
       if($managerVerificationCode == "")
       {
           $VerificationStep=1;
           $Erroverification=1; // Nao pode existir campos vazios
           return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
       }

       if($managerVerificationCode == $VerificationCode)
       {
            //success
           session()->forget('VerificationCode');
           $VerificationStep=2;
           $Erroverification=0;
           return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
       }
       else
       {
           $VerificationStep=1;
           $Erroverification=2; // Os codigos nao correspondem
           return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
       }

    }
    function CheckNewPasswords()
    {
        $novaPassword = $_REQUEST['Newpassword'];
        $ConfirmPassword = $_REQUEST['ConfirmNewpassword'];

        if($novaPassword !="" && $ConfirmPassword !="")
        {
            if($novaPassword == $ConfirmPassword)
            {
                //sucesso
                $emailManager = session()->get('ManagerMail');
                $ManagerInfo = Manager::where('email','=',$emailManager)->first();
                Manager::where('email','=',$emailManager)->update(['password' => bcrypt($novaPassword)]);
                Mail::to($ManagerInfo->email)->send(new MudancaDePassword($ManagerInfo->username,$novaPassword,$ManagerInfo->name));
                session()->forget('ManagerMail');
                $VerificationStep = 3;
                $Erroverification=0;
                return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
            }
            else
            {
                $VerificationStep=2;
                $Erroverification=2; // As passwords nao correspondem
                return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
            }
        }
        else
        {
            $VerificationStep=2;
            $Erroverification=1; // Nao pode existir campos vazios
            return view('manager.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
    }


}


