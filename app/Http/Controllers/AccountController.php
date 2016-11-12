<?php

namespace App\Http\Controllers;
;
use Illuminate\Http\Request;

use App\Http\Requests;
class AccountController extends Controller
{
    public function showForm(Request $request) {
        return view('account.formAdd');
    }
}
