<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
class AccountController extends Controller
{
    /**
     * Renders the wizard that will permit the creation of accounts an clients
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm(Request $request) {
        \Debugbar::info('test');
        return view('manager.add_account_client');
    }
}
