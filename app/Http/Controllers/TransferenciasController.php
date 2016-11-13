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
   public static function VerificaTransferencia()
   {
       $idConta = $_REQUEST['account'];
       $IBANDest = $_REQUEST['IBAN'];
       $Montantetransf = $_REQUEST['Montante'];
       $Descricaotransf=$_REQUEST['DescricaoTransferencia'];
       //$PIN = $_REQUEST['PinCliente'];
       $Erroverificacao=0;
       $TransferenciaInfoDest = CurrentAccount::where('id','=',$IBANDest)->first();
       $TransferenciaInfoOrigem = CurrentAccount::where('id','=',$idConta)->first();
       $IDClientDest = CurrentAccountHasClient::where('current_account_id','=',$IBANDest)->first();
       $ClientInfo = Client::where('id','=',$IDClientDest->client_id)->first();
       if($idConta != "" && $IBANDest !="" && $Montantetransf != "")
       {
           if($TransferenciaInfoDest != NULL)
           {
               if($Montantetransf >0)
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
                       session()->put('NomeClientDest',$ClientInfo->name);
                       $Erroverificacao =0;
                       $VerificactionStep = 1;
                       Mail::to(Auth::user()->email)->send(new CodigoVerificacaoTransferencia($VerificationCode,Auth::user()->name));
                       return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
                   }
                   else
                   {
                       $Erroverificacao = 4;
                       return $Erroverificacao; // nao tem fundos suficientes para realizar a transferencia
                   }
               }
               else
               {
                   $Erroverificacao = 3; // Montante tem que ser maior que 0
                   return $Erroverificacao;
               }
           }
           else
           {
               $Erroverificacao =2; // o iBAN introduzido nao existe
               return $Erroverificacao;
           }
       }
       else
       {
           $Erroverificacao=1; //nao pode haver espaços vazios
            return $Erroverificacao;
       }



   }
    public static function CheckVerificationCode()
    {
        $PinIntroduzido = $_REQUEST['PinCliente'];

        if($PinIntroduzido !="")
        {
            if($PinIntroduzido == session()->get('VerificationCode'))
            {
                CurrentAccount::where('id', '=', session()->get('idContaOrigem'))->update(['balance' => session()->get('MontanteOrigem')]);
                CurrentAccount::where('id', '=', session()->get('idContaDestino'))->update(['balance' => session()->get('MontanteDestino')]);
                $idAccMovement = DB::table('account_movements')->insertGetId(
                    array('description' => session()->get('Description'), 'amount' => session()->get('Montante'),
                        'current_account_id'=>session()->get('idContaOrigem'),
                        'balance_after'=>session()->get('MontanteOrigem'))
                );
                DB::table('tranferences')->insert(
                    array('account_movements_id'=>$idAccMovement,'dest_name'=>session()->get('NomeClientDest'),
                        'dest_iban'=>session()->get('idContaDestino'))
                );


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
                return view('client.transferencias')->with(['ErroVerificacao'=>$Erroverificacao,'VerificationStep'=>$VerificactionStep]);
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