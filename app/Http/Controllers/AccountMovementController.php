<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\CurrentAccount;
use App\ServicesPayment;
use App\StatePayment;
use App\PhoneNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountMovementController extends Controller
{
    /**
     * Renders the form that allow clients to do payments of services
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showServicesForm(Request $request) {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.payments.services',compact('accounts'));
    }

    /**
     * Renders the form that allow clients to do payments of phones
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPhoneForm(Request $request) {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.payments.phone',compact('accounts'));
    }

    /**
     * Renders the form that allow clients to do payments for the state
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStateForm(Request $request) {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;
        return view('client.payments.state',compact('accounts'));
    }

    /**
     * Create a payment of a service
     * @param Request $request
     */
    public function servicePayment(Request $request)
    {
        $this->validationService($request);
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
        return view('client.payments.sucess');
    }

    /**
     * Create a payment for the government
     * @param Request $request
     */
    public function statePayment(Request $request)
    {
        $this->validationState($request);
        DB::transaction(function () use ($request) {
            $account = CurrentAccount::find($request->account);
            $account->balance -= $request->amount;

            $state_payment = new StatePayment();
            $state_payment->reference = $request->reference;

            $movement = new AccountMovement();
            $movement->amount = -$request->amount;
            if (empty($request->description)) {
                $movement->description = "Pag. Estado Ref. ".$state_payment->reference;
            } else {
                $movement->description = $request->description;
            }
            $movement->balance_after = $account->balance;

            $movement->currentAccount()->associate($account);
            $movement->save();

            $state_payment->account_movement()->associate($movement);
            $state_payment->save();

            $account->save();
        });
        return view('client.payments.sucess');
    }

    /**
     * Create a payment of a phone
     * @param Request $request
     */
    public function phonePayment(Request $request)
    {
        $this->validationPhone($request);
        DB::transaction(function () use ($request) {
            $account = CurrentAccount::find($request->account);
            $account->balance -= $request->amount;

            $phone_payment = new PhoneNetwork();
            $phone_payment->entity = $request->entity;
            $phone_payment->phone_number = $request->phone_number;

            $movement = new AccountMovement();
            $movement->amount = -$request->amount;
            if (empty($request->description)) {
                $movement->description = "Pag. Telemóvel Ent.".$phone_payment->entity." N.. ".$phone_payment->phone_number;
            } else {
                $movement->description = $request->description;
            }
            $movement->balance_after = $account->balance;

            $movement->currentAccount()->associate($account);
            $movement->save();

            $phone_payment->account_movement()->associate($movement);
            $phone_payment->save();

            $account->save();
        });
        return view('client.payments.sucess');
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

    /**
     * Validates the data introduced by the user when creating a new services
     * payment using Laravel validations
     * @param Request $request
     */
    public function validationService(Request $request)
    {
        $this->validate($request, [
            'entity' => 'required|integer',
            'reference' => 'required|integer',
            'amount' => 'required|amount_balance:'.$request->account,
        ]);
    }

    /**
     * Validates the data introduced by the user when creating a new services
     * payment using Laravel validations
     * @param Request $request
     */
    public function validationState(Request $request)
    {
        $this->validate($request, [
            'reference' => 'required|integer',
            'amount' => 'required|amount_balance:'.$request->account,
        ]);
    }

    /**
     * Validates the data introduced by the user when creating a new services
     * payment using Laravel validations
     * @param Request $request
     */
    public function validationPhone(Request $request)
    {
        $this->validate($request, [
            'entity' => 'required|integer',
            'phone_number' => 'required|integer|min:900000000|max:999999999',
            'amount' => 'required|amount_balance:'.$request->account,
        ]);
    }
}
