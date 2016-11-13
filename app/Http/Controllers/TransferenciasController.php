<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 12/11/16
 * Time: 17:25
 */

namespace App\Http\Controllers;

use App\Client;
use App\CurrentAccount;
use App\AccountMovement;
use App\Transferences;
use Illuminate\Http\Request;
use App\CurrentAccountHasClient;
use App\Http\Requests;
use App\Mail\CodigoVerificacaoTransferencia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferenciasController extends Controller
{
    public function showForm()
    {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;

        $ErroVerificacao = 0;
        $VerificactionStep = 0;
        return view('client.transferencias',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
    }

    public function VerificaTransferencia(Request $request)
    {
        $idConta = $request->account;
        $IBANDest = $request->IBAN;
        $Montantetransf = $request->Montante;
        $Descricaotransf= $request->DescricaoTransferencia;
        //$PIN = $_REQUEST['PinCliente'];
        $VerificactionStep = 0;
        $TransferenciaInfoDest = CurrentAccount::find($IBANDest);
        $TransferenciaInfoOrigem = CurrentAccount::find($idConta);
        $IDClientDest = $TransferenciaInfoDest->clients()->first();
        $ClientDestInfo = Client::find($IDClientDest->id);
        $ClientOrInfo = Client::find(Auth::id());
        if($idConta != "" && $IBANDest !="" && $Montantetransf != "")
        {
            if($TransferenciaInfoDest != NULL)
            {
                if($Montantetransf > 0)
                {
                    if($Montantetransf <= $TransferenciaInfoOrigem->balance)
                    {
                        $MontanteOrigem = $TransferenciaInfoOrigem->balance;
                        $MontanteOrigem = $MontanteOrigem - $Montantetransf;
                        $MontanteDestino = $TransferenciaInfoDest->balance;
                        $MontanteDestino = $MontanteDestino + $Montantetransf;
                        $VerificationCode = str_random(5);
                        session()->put('VerificationCode',$VerificationCode);
                        session()->put('MontanteOrigem',$MontanteOrigem);
                        session()->put('MontanteDestino',$MontanteDestino);
                        session()->put('idContaOrigem',$idConta);
                        session()->put('idContaDestino',$IBANDest);
                        session()->put('Description',$Descricaotransf);
                        session()->put('Montante',$Montantetransf);
                        session()->put('NomeClientDest',$ClientDestInfo->name);
                        session()->put('NomeClientOrigem',$ClientOrInfo->name);
                        $Erroverificacao =0;
                        $VerificactionStep = 1;
                        Mail::to(Auth::user()->email)->send(new CodigoVerificacaoTransferencia($VerificationCode,Auth::user()->name));
                        return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
                    }
                    else
                    {
                        $Erroverificacao = 4;
                        return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]); // nao tem fundos suficientes para realizar a transferencia
                    }
                }
                else
                {
                    $Erroverificacao = 3; // Montante tem que ser maior que 0
                    return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
                }
            }
            else
            {
                $Erroverificacao =2; // o iBAN introduzido nao existe
                return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
            }
        }
        else
        {
            $Erroverificacao=1; //nao pode haver espaços vazios
            return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
        }



    }
    public function CheckVerificationCode(Request $request)
    {
        $PinIntroduzido = $request->PinCliente;

        if($PinIntroduzido !="")
        {
            if($PinIntroduzido == session()->get('VerificationCode'))
            {
                DB::transaction(function () {
                    $contaOrigem = CurrentAccount::find(session()->get('idContaOrigem'));
                    $contaDestino = CurrentAccount::find(session()->get('idContaDestino'));

                    $contaOrigem->balance = session()->get('MontanteOrigem');
                    $contaDestino->balance = session()->get('MontanteDestino');

                    $transference = new Transferences();
                    $transference->dest_name = session()->get('NomeClientDest');
                    $transference->dest_iban = session()->get('idContaDestino');

                    $movementOrigem = new AccountMovement();
                    if (empty(session()->get('Description')))
                    {
                        $Descricaotransf = "Trânsferência para ". session()->get('NomeClientDest');
                    }
                    else
                    {
                        $Descricaotransf = session()->get('Description');
                    }
                    $movementOrigem->description = $Descricaotransf;
                    $movementOrigem->amount = -session()->get('Montante');
                    $movementOrigem->balance_after = session()->get('MontanteOrigem');

                    $movementDestino = new AccountMovement();
                    if (empty(session()->get('Description')))
                    {
                        $Descricaotransf = "Trânsferência de ". session()->get('NomeClientOrigem');
                    }
                    else
                    {
                        $Descricaotransf = session()->get('Description');
                    }
                    $movementDestino->description = $Descricaotransf;
                    $movementDestino->amount = session()->get('Montante');
                    $movementDestino->balance_after = session()->get('MontanteDestino');

                    $movementOrigem->currentAccount()->associate($contaOrigem);
                    $movementOrigem->save();

                    $movementDestino->currentAccount()->associate($contaDestino);
                    $movementDestino->save();

                    $transference->account_movement()->associate($movementOrigem);
                    $transference->save();

                    $contaOrigem->save();
                    $contaDestino->save();

                    session()->forget('VerificationCode');
                    session()->forget('MontanteOrigem');
                    session()->forget('MontanteDestino');
                    session()->forget('idContaOrigem');
                    session()->forget('idContaDestino');
                    session()->forget('Description');
                    session()->forget('Montante');
                    session()->forget('NomeClientDest');

                    $Erroverificacao = 0;//sucesso
                    $VerificactionStep = 2;
                    return view('client.transferencias')->with(['ErroVerificacao' => $Erroverificacao, 'VerificationStep' => $VerificactionStep]);
                });
            }
            else
            {
                $Erroverificacao = 2;//o pin nao corresponde
                $VerificactionStep = 1;
                return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
            }
        }
        else
        {
            $Erroverificacao = 1;//nao pode haver espacos vazios
            $VerificactionStep = 1;
            return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
        }

    }

}