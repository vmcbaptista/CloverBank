<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\CurrentAccount;
use App\ServicesPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountMovementController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }

    public function showForm(Request $request) {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.payments.services',compact('accounts'));
    }

    public function servicePayment(Request $request)
    {
        #TODO: Verificar se o cliente tem saldo antes de efetuar transação
        DB::transaction(function () use ($request) {
            $account = CurrentAccount::find($request->account);
            $account->balance -= $request->amount;

            $service_payment = new ServicesPayment();
            $service_payment->entity = $request->entity;
            $service_payment->reference = $request->reference;

            $movement = new AccountMovement();
            $movement->amount = -$request->amount;
            $movement->description = $request->description;

            $movement->currentAccount()->associate($account);
            $movement->save();

            $service_payment->account_movement()->associate($movement);
            $service_payment->save();

            $account->save();
        });
    }
}
