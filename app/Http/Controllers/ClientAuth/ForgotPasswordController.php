<?php

namespace App\Http\Controllers\ClientAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordCode;
use App\Client;
use Validator;
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
        return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
    }

    function CheckEmail()
    {
        $ClientMail = $_REQUEST['EmailClient'];
        $ClientInfo = Client::where('email','=',$ClientMail)->first();

        if($ClientMail == "")
        {
            $VerificationStep=0;
            $Erroverification=1; // Nao pode existir campos vazios
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
        if($ClientInfo != NULL)
        {
            $VerificationStep=1;
            $Erroverification=0;
            $VerificationCode = str_random(4);
            session()->put('VerificationCode',$VerificationCode);
            session()->put('ClientMail',$ClientMail);

            Mail::to($ClientMail)->send(new ResetPasswordCode($VerificationCode,$ClientInfo->name));
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
        else
        {
            $VerificationStep=0;
            $Erroverification=2; // nao existe nenhuma conta com esse email associado
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
    }

    function CheckVerificationCode()
    {

        $VerificationCode=session()->get('VerificationCode');
        $clientVerificationCode = $_REQUEST['verificationCode'];
        if($clientVerificationCode == "")
        {
            $VerificationStep=1;
            $Erroverification=1; // Nao pode existir campos vazios
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }

        if($clientVerificationCode == $VerificationCode)
        {
            //success
            session()->forget('VerificationCode');
            $VerificationStep=2;
            $Erroverification=0;
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
        else
        {
            $VerificationStep=1;
            $Erroverification=2; // Os codigos nao correspondem
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
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
                $emailClient = session()->get('ClientMail');
                $ClientInfo = Client::where('email','=',$emailClient)->first();
                Client::where('email','=',$emailClient)->update(['password' => bcrypt($novaPassword)]);
                Mail::to($ClientInfo->email)->send(new MudancaDePassword($ClientInfo->username,$novaPassword,$ClientInfo->name));
                session()->forget('ClientMail');
                $VerificationStep = 3;
                $Erroverification=0;
                return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
            }
            else
            {
                $VerificationStep=2;
                $Erroverification=2; // As passwords nao correspondem
                return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
            }
        }
        else
        {
            $VerificationStep=2;
            $Erroverification=1; // Nao pode existir campos vazios
            return view('client.auth.passwords.reset')->with(['VerificationStep'=>$VerificationStep,'ErroVerification'=>$Erroverification]);
        }
    }
}
