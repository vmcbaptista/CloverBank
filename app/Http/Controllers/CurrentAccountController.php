<?php

namespace App\Http\Controllers;

use App\Client;
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
                    array_push($cliId, json_decode($cli,true)["id"]);
                }
                else {
                    array_push($cliId, $client->id);
                }
            }

            $currentAccount = new CurrentAccount();
            $currentAccount->currentProduct()->associate($request->product);
            $currentAccount->balance = $request->amount;
            //TODO: Falta arranjar uma forma de introduzir o gestor e o balcão
            $currentAccount->manager()->associate(1);
            $currentAccount->branch()->associate(1);
            $currentAccount->save();
            $currentAccount->clients()->attach($cliId);


        });
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
}
