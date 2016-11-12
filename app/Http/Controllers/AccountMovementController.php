<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\CurrentAccount;
use App\ServicesPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountMovementController extends Controller
{
    /**
     * Renders the form that allow clients to do payments of services
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm(Request $request) {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.payments.services',compact('accounts'));
    }

    /**
     * Create a payment of a a service
     * @param Request $request
     */
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
            if (empty($request->description)) {
                $movement->description = "Pag. Serviço Ent.".$service_payment->entity." Ref. ".$service_payment->reference;
            } else {
                $movement->description = $request->description;
            }
            $movement->balance_after = $account->balance;

            $movement->currentAccount()->associate($account);
            $movement->save();

            $service_payment->account_movement()->associate($movement);
            $service_payment->save();

            $account->save();
        });
    }

    /**
     * Get all the movements related with a specific account
     * @param $account_id
     * @return mixed
     */
    public function getMovements($account_id)
    {
        $account = CurrentAccount::find($account_id);
        $movements = $account->movements()->orderBy('created_at','DESC')->get();
        return $movements;
    }
}
