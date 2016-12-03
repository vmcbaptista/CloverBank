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
        // First we'll validate the data related with the account is OK.
        // We need to create a new request since Laravel built-in validations
        // require the data passed in form of Request
        $accountData = json_decode($request->newAccount);
        $this->validation(Request::create('account/saving/add','post', array(
            'product' => $accountData->product,
            'amount' => $accountData->amount,
        )));
        // Use of transactions since we'll manipulate several tables
        DB::transaction(function () use($request,$accountData) {
            // Populate the tables and creates the relations needed
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

    /**
     * Method invoked by AJAX request in form validations to check if the initial amount
     * introduced satisfies the conditions of the account
     * @param Request $request
     * @return string
     */
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

    /**
     * Validates the data introduced by the user when creating a new account using
     * Laravel validations
     * @param Request $request
     */
    public function validation(Request $request)
    {
        $this->validate($request, [
            'product' => 'required|exists:product_saving,id',
            'amount' => 'required|amount_saving_conditions:'.$request->product,
        ]);
    }
}
