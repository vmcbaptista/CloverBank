<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\ProductSaving;
use App\Savings;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SavingAccountController extends Controller
{

    /**
     * Add news saving account
     * @param Request $request
     */
    public function add(Request $request)
    {
        DB::transaction(function () use($request) {
            $savingAccount = new Savings();
            $savingAccount->savingProduct()->associate(ProductSaving::find($request->product));
            $savingAccount->amount = $request->amount;
            $savingAccount->currentAccount()->associate(CurrentAccount::find($request->account));
            $savingAccount->save();
        });
    }
}
