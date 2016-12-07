<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 04/12/16
 * Time: 18:05
 */

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\CurrentAccountHasClient;
use App\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AccountMovement;

class Deposits
{
    function ShowDepositsPage()
    {
        $VerificactionStep = 1;
        $ErroVerificacao =0;
        return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
    }

    function ShowNifForm()
    {
        $VerificactionStep = 7;
        $ErroVerificacao =0;
        return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
    }
    function checkNIF()
    {
        $IBAN = $_REQUEST['NIF'];
        $accounts = CurrentAccount::find($IBAN);
        session()->put('IBANDest',$IBAN);
        session()->put('accounts',$accounts);
        $ErroVerificacao = 0;
        $VerificactionStep=5;
        return view('manager.deposits',compact('clients'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
    }

    //ALL functions necessary to do a deposit from a search on IBAN
    function ShowIbanForm()
    {
        $VerificactionStep = 2; //shows the form that allow the input of IBAN
        $ErroVerificacao =0;
        return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
    }

    //take care of the verifications for IBAN form
    function checkIBAN()
    {
        $IBAN = $_REQUEST['IBAN'];
        $accounts = CurrentAccount::find($IBAN);

        if($IBAN!="")
        {
            if($accounts !=NULL)
            {
                $VerificactionStep = 4;
                $ErroVerificacao=0;
                $clients = $accounts->clients;
                session()->put('IBANDest',$IBAN);
                session()->put('accounts',$accounts);

                return view('manager.deposits',compact('clients'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
            }
            else
            {
                $VerificactionStep = 2;
                $ErroVerificacao =2;
                return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
            }
        }
        else
        {
            $VerificactionStep = 2;
            $ErroVerificacao =1;
            return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
        }
    }

    function makeDeposit()
    {
        $valorDepositar = $_REQUEST['amount'];
        $IBAN = session()->get('IBANDest');
        $accounts = session()->get('accounts');

        if($valorDepositar!="")
        {
            if($valorDepositar>0)
            {
                DB::transaction(function () use($valorDepositar,$IBAN,$accounts)  {


                    $movement = new AccountMovement();
                    $Descricaotransf = "Deposito realizado no banco";
                    $movement->description = $Descricaotransf;
                    $movement->amount = $valorDepositar;
                    $movement->balance_after = $accounts->balance+$valorDepositar;
                    $accounts->balance = $movement->balance_after;
                    $movement->currentAccount()->associate($accounts);
                    $movement->save();
                    $accounts->save();

                });
                $VerificationStep = 6; //success
                $ErroVerificacao =0;
                return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificationStep]);
            }
            else
            {
                $VerificactionStep = 5;
                $ErroVerificacao =1;
                return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
            }
        }
        else
        {
            $VerificactionStep = 5;
            $ErroVerificacao =1;
            return view('manager.deposits',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
        }
    }
}