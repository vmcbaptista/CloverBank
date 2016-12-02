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
        DB::transaction(function () use($request) {
            $accountData = json_decode($request->newAccount);
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
}
