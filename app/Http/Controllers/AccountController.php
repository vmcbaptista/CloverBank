<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ClientType;

class AccountController extends Controller
{
    public function showForm(Request $request) {
        $client_types = ClientType::all();
        return view('account.formAdd',compact('client_types'));
    }
}
