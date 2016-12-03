<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\Loan;
use App\ProductLoan;
use App\AccountMovement;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{

    /**
     * Add new loan
     * @param Request $request
     */
    public function add(Request $request)
    {
        // First we'll validate the data related with the account is OK.
        // We need to create a new request since Laravel built-in validations
        // require the data passed in form of Request
        $accountData = json_decode($request->newAccount);
        $this->validation(Request::create('account/loan/add','post', array(
            'product' => $accountData->product,
            'amount' => $accountData->amount,
        )));
        // Use of transactions since we'll manipulate several tables
        DB::transaction(function () use($request,$accountData) {
            // Populate the tables and creates the relations needed
            $currentAccount = CurrentAccount::find($request->account);
            $loan = new Loan();
            $loan->loanProduct()->associate(ProductLoan::find($accountData->product));
            $loan->amount = $accountData->amount;
            $loan->currentAccount()->associate($currentAccount);
            $loan->save();
            $movement = new AccountMovement();
            $movement->description = 'Depósito Crédito';
            $movement->amount = $accountData->amount;
            $movement->balance_after = $currentAccount->balance + $accountData->amount;
            $currentAccount->movements()->save($movement);
        });
        return redirect('/manager/home');
    }

    /**
     * Method invoked by AJAX request in form validations to check if the initial amount
     * introduced satisfies the conditions of the account
     * @param Request $request
     * @return string
     */
    public function validateInitialAmount(Request $request)
    {
        $loan = ProductLoan::find($request->product);
        $initialAmount = $request->amount;
        $product = $loan->belongsTOne_product()->first();
        if ($initialAmount < $product->min_amount || $initialAmount > $loan->max_amount)
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
            'product' => 'required|exists:product_loan,id',
            'amount' => 'required|amount_loan_conditions:'.$request->product,
        ]);
    }
}
