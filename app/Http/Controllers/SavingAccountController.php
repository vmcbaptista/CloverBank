<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\ProductSaving;
use App\Savings;
use App\AccountMovement;
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
            $accountData = json_decode($request->newAccount);
            $currentAccount = CurrentAccount::find($request->account);
            $savingAccount = new Savings();
            $savingAccount->savingProduct()->associate(ProductSaving::find($accountData->product));
            $savingAccount->amount = $accountData->amount;
            $savingAccount->currentAccount()->associate($currentAccount);
            $savingAccount->save();
            $movement = new AccountMovement();
            $movement->description = 'Constituição de Conta Poupança';
            $movement->amount = -$accountData->amount;
            $movement->balance_after = $currentAccount->balance - $accountData->amount;
            $currentAccount->movements()->save($movement);
        });
        return redirect('/manager/home');
    }

    public function validateInitialAmount(Request $request)
    {
        $saving = ProductSaving::find($request->product);
        $initialAmount = $request->amount;
        $product = $saving->belongsTOne_product()->first();
        if ($initialAmount < $product->min_amount || $initialAmount > $saving->max_amount)
        {
            return "false";
        }
        return "true";
    }
}
