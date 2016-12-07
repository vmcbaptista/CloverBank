<?php

namespace App\Http\Controllers;

use App\Client;
use App\CurrentAccount;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Product;
use App\ProductCurrent;
use App\ProductSaving;
use App\Savings;
use App\AccountMovement;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use stdClass;

class SavingAccountController extends Controller
{

    /**
     * Renders a forms that allow a client to ask for a saving account
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showClientForm(){

        $savings = ProductSaving::all();
        $products = Product::all();
        return view('client.ask_for_savingAccount')->with('savings',$savings)->with('products',$products)->with('step',1);
    }

    /**
     * Ii will render the form to send
     * for the user to be able to send and
     * ajax request.
     */
    public function showSavings(){
        $client = Auth::guard('client')->user();
        $allCurrentAccounts = $client->accounts;
        return view('client.checkSavings')->with('currentAccounts',$allCurrentAccounts);//->with('client',$client);
    }

    /**
     * Returns an Array with all saving accounts associated to the selected current account
     * @param $id
     * @return string
     */
    public function getSavings($id){
        $allData = array();

        $client = Auth::guard('client')->user();
        $currentAccount = $client->accounts->where('id','=',$id)->first();
        $getAllAssociatedSavings = $currentAccount->savings;

        foreach ($getAllAssociatedSavings as $saving){
            $m_Data = array();

            $m_Data['id'] = $saving->id;
            $m_Data['amount'] = $saving->amount;
            $m_Data['duration'] = $saving->savingProduct->duration;
            $m_Data['dataLimite'] = $saving->created_at->addMonths($m_Data['duration']);
            $m_Data['juro'] = $saving->savingProduct->tanb;
                                        //Juro          Quantidade a Render
            $m_Data['savedMoney'] = ($m_Data['juro']/100)*$m_Data['amount'];

            array_push($allData, $m_Data);
        }


        return json_encode($allData);
    }


    /**
     * Middle Step when asking for a Saving Account
     * Client choses the amount to create the saving and which account it wants
     * @param Request $request
     * @return
     */
    public function savingMediumStep(Request $request){

        $chosenSaving = ProductSaving::where('id','=',$request->savingId)->first();
        $chosenProd = Product::where('id','=',$chosenSaving->product_id)->first();
        $availableAccs = Auth::guard('client')->user()->accounts;
        return view('client.ask_for_savingAccount')
            ->with('request',$request)
            ->with('chosenSaving',$chosenSaving)
            ->with('chosenProduct',$chosenProd)
            ->with('currentAccounts', $availableAccs)
            ->with('step',2);
    }

    /**
     * Makes a Json with data to send to add function that was created before
     * @param Request $request
     */
    public function addJson(Request $request){
        //Make the Json
        $json = new stdClass();
        $json->product = $request->savingId;
        $json->amount = $request->amount;
        $request->newAccount = json_encode($json);
        $this->add($request);
    }

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
        $this->validation(Request::create('account/saving/add', 'post', array(
            'product' => $accountData->product,
            'amount' => $accountData->amount,
        )));
        // Use of transactions since we'll manipulate several tables
        DB::transaction(function () use ($request, $accountData) {
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
        if (Auth::guard('client')->check()) {
            return redirect('/client/home');
        }else{
            return redirect('/manager/home');
        }
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
