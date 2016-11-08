<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\Loan;
use App\ProductLoan;
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
            $loan = new Loan();
            $loan->loanProduct()->associate(ProductLoan::find($request->product));
            $loan->amount = $request->amount;
            $loan->currentAccount()->associate(CurrentAccount::find($request->account));
            $loan->save();
        });
    }
}
