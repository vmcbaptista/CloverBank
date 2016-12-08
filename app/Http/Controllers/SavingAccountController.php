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
use Carbon\Carbon;

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
    public function showSavings($id){
        $client = Auth::guard('client')->user();
        $allCurrentAccounts = $client->accounts;
        if($id == 1) {
            return view('client.checkSavings')->with('currentAccounts', $allCurrentAccounts);//->with('client',$client);
        }
        elseif($id==2){ //redirects to delete page
            return view('client.deleteSavings')->with('currentAccounts', $allCurrentAccounts);
        }
        else{ //if don't know where the user wants to go redirect it to the main page.
            return view('client.home')->with('accounts',$allCurrentAccounts);
        }
    }

    /**
     * The user confirmed that he want to remove it's money from the saving
     * @param $id -> saving Account ID
     */
    public function confirmDelete($id){
        //Check if the thing is valid and hte account belong to the user
        $client = Auth::guard('client')->user();
        $currentAccounts = $client->accounts;
        if($this->validateAccount($currentAccounts,$id))
        {
            DB::transaction(function () use ($id) {
                //Now that I know that my account is really mine get the current account to which saving is associated
                $savingAccount = Savings::find($id);
                $currentAccount = $savingAccount->currentAccount;

                //Add the money back to the user + the juro
                $amountReceived = $this->giveBackAmount($currentAccount, $savingAccount ,$savingAccount->savingProduct);

                //Add to the notification table saying that you've closed the account
                $movement = new AccountMovement();
                $movement->description = 'Liquidação de Conta Poupança';
                $movement->amount = $amountReceived;
                $movement->balance_after = $currentAccount->balance + $amountReceived;
                $currentAccount->movements()->save($movement);

                //Balance on current Account Updated
                $currentAccount->balance = $currentAccount->balance  + $amountReceived;
                $currentAccount->save();
                \Debugbar::info($currentAccount->id);

                //Delete row from database
                DB::table('savings')->where('id', '=', $id)->delete();
            });

        }
        else
        {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            $result=array();
            $result['messages'] = "This account doesn't belong to you";
            die(json_encode($result));
        }
    }

    /**
     * Calculate the money I need to give back to a user
     * @param $currentAccount
     * @param $saving
     */
    private function giveBackAmount($currentAccount, $savingAccount ,$savingProduct){
        $amountToGiveBack = $savingAccount->amount;
        $yearAmountGained = $savingAccount->amount * ($savingProduct->tanb/100) ;
        $monthlyGain = $yearAmountGained/12;

        $creationData = $savingProduct->created_at;
        $finishDate = $creationData->addMonths($savingProduct->duration);
        $today = Carbon::now('Europe/London');

        //Months to finish
        $diffMonths = $today->diffInMonths($finishDate);

        #Need to be checked with higger attention because there are sometricks
        if($diffMonths > 0 ){
            //Apply Sanction for each month
            $monthlyGain = $monthlyGain * 0.5;
            if($savingProduct->duration - $diffMonths) { //won't give you money
                return $amountToGiveBack;
            }
            else{
                for ($i = 0; $i < ($savingProduct->duration - $diffMonths); $i++) {
                    //\Debugbar::info($i);
                    $amountToGiveBack = $amountToGiveBack + $monthlyGain;
                }
            }

            return $amountToGiveBack;
        }
        else{
            #TODO: Add the correct calculus according with what Paulo is doing
            #TODO: CronJobs SHould be used to for the account and renew old depositos
            //give all the saved money back;
            for($i = 0; $i < $savingProduct->duration; $i++){
                $amountToGiveBack = $amountToGiveBack + $monthlyGain;
            }
        }


    }

    /**
     * Given all the current account this will check if the user owns the account that s/he is trying to remove.
     * @param $currentAccounts
     * @param $id
     * @return bool
     */
    private function validateAccount($currentAccounts,$id)
    {
        foreach ($currentAccounts as $currentAccount)
        {
            foreach ($currentAccount->savings as $saving){
                if($saving->id == $id){
                    return true;
                }
            }
        }
        return false;
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
