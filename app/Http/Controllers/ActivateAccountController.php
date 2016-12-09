<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Client;
use App\CurrentAccount;
use App\Product;
use Auth;
use Mail;
use App\Mail\SendLoginInfo;
use DB;
use Illuminate\Http\Request;

class ActivateAccountController extends Controller
{
    /**
     * Presents all the inactive accounts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInactiveAccount(){
        $step = 1;
        $inactiveAccounts = $this->checkInactiveAccounts();
        return view("manager.activateAccount",compact("inactiveAccounts","step"));
    }

    /**
     * Add Product
     * Add Balcon
     * Add Money
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function middleStep(Request $request){
        $step = $request->step;

        $allProducts =  Product::where('prod_type' ,'=', 'current')->get();
        $branchs = Branch::all();
        return view("manager.activateAccount",compact("request","step","allProducts", "branchs"));
    }

    /**
     * Final step of account activation creation of the entities and insertion on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activationStateFinal(Request $request){
        $step = 3;
        $password = str_random(8);

        DB::transaction(function () use ($request, $password) {
            //Querys the user
            $client = Client::where('nif','=', $request->nif)->get()->first();

            //Generates the product
            $currentAccount = new CurrentAccount();
            $currentAccount->currentProduct()->associate($request->product);
            $currentAccount->balance = $request->amount;
            $currentAccount->manager()->associate(Auth::guard('manager')->id());
            $currentAccount->branch()->associate($request->branch);
            $currentAccount->save();
            $currentAccount->clients()->attach($client->id);

            //Client Insertion
            $client->password = bcrypt($password);
            $client->accountState = 1;
            $client->save();

        });
        $client = Client::where('nif','=', $request->nif)->get()->first();

        //Send an email with the data to login
        Mail::to($request->email)->send(new SendLoginInfo($client->username,$password,$client->name));
        return view("manager.activateAccount",compact("step","request"));
    }

    /**
     * Querys the db for inactive accounts
    */
    private function checkInactiveAccounts(){
        return Client::where('accountState','=',0)->get();
    }
}
