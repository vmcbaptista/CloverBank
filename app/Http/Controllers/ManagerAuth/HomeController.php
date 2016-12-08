<?php

namespace App\Http\Controllers\ManagerAuth;
use App\Client;
use App\CurrentAccount;
use App\Http\Controllers\Controller;

use App\Loan;
use App\Savings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        $client = \Auth::guard('manager')->user();
        $accounts = $client->accounts;
        $this->bankData();
        return view('manager.home',compact('accounts'));
    }

    /**
     * Returns all data to the manager's home page
     */
    public function bankData(){
        $information = array();
        $information['accSavings'] = Savings::count();
        $information['accCurrent'] = CurrentAccount::count();
        $information['accLoan'] = Loan::count();
        $information['numCli'] = Client::where('accountState','=',1)->count();
        $information['inactiveAcc'] = Client::where('accountState','=',0)->count();
        $information['allBalance'] = CurrentAccount::sum('balance');

        //\Debugbar::info(json_encode($information));
        return json_encode($information);

    }

}
