<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 16/12/16
 * Time: 17:16
 */

namespace App\Http\Controllers;
use App\ProductCurrent;
use PDF;
use Dompdf\Dompdf;
use App\Client;
use App\AccountMovement;
use App\Product;
use App\CurrentAccount;
use App\Http\Controllers\View;
use App\Http\Controllers\DateTime;
use Illuminate\Support\Facades\Auth;
use App\Transferences;
use DB;


class PDFHandler
{

    function CreatePDF()
    {
        $client = \Auth::guard('client')->user();
        $NomeCliente = $client->name;

        $date = date("d-m-y");
        $hours = date("H:i:s");

        $Idconta = $_REQUEST['Account'];
        $Balance = $_REQUEST['Balance'];
        $Conta = DB::table('current_account')->where('id', $Idconta)->first();
        $ProductCurrent = DB::table('product_current')->where('id', $Conta->product_current_id)->first();
        $Product = DB::table('product')->where('id', $ProductCurrent->product_id)->first();
        $Movements = AccountMovement::where('current_account_id',$Idconta)->get();
        $dompdf = new DOMPDF();
        $dompdf->setBasePath("css/forms.css");
        $view = \View::make('client.PDFView')->with(['Name'=>$NomeCliente,
            'Balance'=>$Balance,'hours'=>$hours,'date'=>$date,'Movements'=>$Movements,'Product'=>$Product]);
        $contents = $view->render();
        $dompdf->loadHtml($contents);
        $dompdf->render();
        $dompdf->stream("Movimentos");



    }
}