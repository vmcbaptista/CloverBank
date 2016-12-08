<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\Client;
use App\CurrentAccount;
use App\Http\Controllers\ClientAuth\RegisterController;
use App\Product;
use App\ProductCurrent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Support\Facades\DB;

class CurrentAccountController extends Controller
{
    /**
     * Add news current account and user if the person isn't yet a client of the bank
     * @param Request $request
     */
    public function add(Request $request)
    {
        // First we'll validate the data related with the account is OK.
        // We need to create a new request since Laravel built-in validations
        // require the data passed in form of Request
        $accountData = json_decode($request->newAccount);
        $this->validation(Request::create('account/current/add','post', array(
            'product' => $accountData->product,
            'amount' => $accountData->amount,
        )));
        // Use of transactions since we'll manipulate several tables
        DB::transaction(function () use($request, $accountData) {
            $clientData = json_decode($request->cliData);
            $cliId = array();
            foreach ($clientData as $client) {
                if ($client->new == true) {
                    // Create a Request with the data of the client and then pass it
                    // to the RegisterController of the Client which already has all the
                    // logic needed to register a new client
                    $cli = Request::create('/client/register', 'post', array(
                        '_token' => csrf_token(),
                        'name' => $client->name,
                        'email' => $client->email,
                        'address'=> $client->address,
                        'phone'=> $client->phone,
                        'nif'=> $client->nif,
                    ));
                    $regController = new RegisterController();
                    $newCliId = $regController->register($cli);

                    array_push($cliId, $newCliId);
                }
                else {
                    array_push($cliId, $client->id);
                }
            }
            // Populate the tables and creates the relations needed
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
        $success = true;
        return view('manager.add_account_client',compact('success'));
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

    /**
     * Returns the balance of a given account
     * @param $id
     * @return mixed
     */
    public function balance($id)
    {
        return CurrentAccount::find($id)->balance;
    }

    /**
     * Method invoked by AJAX request in form validations to check if the initial amount
     * introduced satisfies the conditions of the account
     * @param Request $request
     * @return string
     */
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

    /**
     * Validates the data introduced by the user when creating a new account using
     * Laravel validations
     * @param Request $request
     */
    public function validation(Request $request)
    {
        $this->validate($request, [
            'product' => 'required|exists:product_current,id',
            'amount' => 'required|amount_current_conditions:'.$request->product,
        ]);
    }

    /**
     * Prepares the view to show informations about the accounts of a client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAccountsInfo()
    {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.accountsInfo',compact('accounts'));
    }
}
