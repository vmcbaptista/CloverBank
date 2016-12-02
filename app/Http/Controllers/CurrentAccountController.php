<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\Client;
use App\CurrentAccount;
use App\Product;
use App\ProductCurrent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Support\Facades\DB;

class CurrentAccountController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('manager');
    }
    */

    /**
     * Add news current account and user if the person isn't yet a client of the bank
     * @param Request $request
     */
    public function add(Request $request)
    {
        DB::transaction(function () use($request) {
            $clientData = json_decode($request->cliData);
            $cliId = array();
            foreach ($clientData as $client) {
                if ($client->new == true) {
                    $cli = ClientController::add($client);
                    array_push($cliId, $cli);
                }
                else {
                    array_push($cliId, $client->id);
                }
            }
            $accountData = json_decode($request->newAccount);
            $currentAccount = new CurrentAccount();
            $currentAccount->currentProduct()->associate($accountData->product);
            $currentAccount->balance = $accountData->amount;
            //TODO: Falta arranjar uma forma de introduzir o balcão
            $currentAccount->manager()->associate(Auth::guard('manager')->id());
            $currentAccount->branch()->associate(1);
            $movement = new AccountMovement();
            $movement->description = 'Depósito Inicial';
            $movement->amount = $accountData->amount;
            $movement->balance_after = $accountData->amount;
            $currentAccount->save();
            $currentAccount->movements()->save($movement);
            $currentAccount->clients()->attach($cliId);
        });
        return redirect('/manager/home');
    }

    /**
     * Search for all the currents accounts that a given client has
     * @param $clientId int the id of the client we are searching accounts
     */
    public function search($clientId)
    {
        $client = Client::find($clientId);
        $acc = array();
        foreach ($client->accounts as $account) {
            $name = $account->currentProduct->belongsTOne_product->name;
            $clients = $account->clients;
            $cli = array();
            $cli['others'] = array();
            $i = 0;
            foreach ($clients as $aCli) {
                if ($i == 0)
                    $cli['first'] = $aCli->name;
                else if ($i == 1)
                    $cli['second'] = $aCli->name;
                else
                    array_push($cli['others'], $aCli->name);
                $i++;
            }
            array_push($acc,array("id" => $account->id, "account" => $name, "clients" => $cli));
        }
        return $acc;
    }

    public function balance($id)
    {
        return CurrentAccount::find($id)->balance;
    }

    public function validateInitialAmount(Request $request)
    {
        $productCurrent = ProductCurrent::find($request->product);
        $initialAmount = $request->amount;
        $product = $productCurrent->belongsTOne_product()->first();
        if ($initialAmount < $product->min_amount)
        {
            return "false";
        }
        return "true";
    }
}
