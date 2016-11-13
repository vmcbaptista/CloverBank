<?php

namespace App\Http\Controllers\ManagerAuth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;

        return view('client.home',compact('accounts'));
    }
}
