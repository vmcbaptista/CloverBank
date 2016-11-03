<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\CurrentAccountHasClient;
use App\Product;
use App\ProductCurrent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\ClientType;
use Illuminate\Support\Facades\DB;

class CurrentAccountController extends Controller
{
    public function showForm(Request $request) {
        $products = ProductCurrent::all();
        $prod_list = array();
        foreach ($products as $product) {
            $prod = Product::findOrFail($product->id);
            array_push($prod_list,array('id' => $product->id, 'name' => $prod->name));
        }
        $client_types = ClientType::all();
        return view('account.formAdd')->with('prod_list',$prod_list)->with(compact('client_types'));
    }

    public function add(Request $request)
    {
        DB::transaction(function () use($request) {
            $cliId = $request->clientId;
            if (empty ($cliId)) {
                $clientData = json_decode($request->cliData);
                $cli = ClientController::add($clientData);
                $cliId = json_decode($cli,true)["id"];
            }
            $currentAccount = new CurrentAccount();
            $currentAccount->product_current_id = $request->product;
            $currentAccount->balance = $request->amount;
            //TODO: Falta arranjar uma forma de introduzir o gestor e o balcão
            $currentAccount->manager_id = 1;
            $currentAccount->branch_id = 1;
            $currentAccount->save();
            $this->associateClientAccount($currentAccount->id, $cliId);


        });
    }

    private function associateClientAccount($account,$client)
    {
        $assoc = new CurrentAccountHasClient();
        $assoc->client_id = $client;
        $assoc->current_account_id = $account;
        $assoc->save();
    }
}
