<?php

namespace App\Http\Controllers\ClientAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showHome()
    {
        $client = \Auth::guard('client')->user();
        $accounts = $client->accounts;

        return view('client.home',compact('accounts'));
    }
}
