<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;
use App\ClientType;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLoginInfo;

class ClientController extends Controller
{
    /**
     * Returns the client with a specific NIF
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        return Client::where('nif', '=', $request->nif)->firstOrFail();
    }

    /**
     * This method is invoked by AJAX in form validations to check if the NIF introdued
     * already exists
     * @param Request $request
     * @return string
     */
    public function checkNif(Request $request)
    {
        if (!Client::where('nif', '=', $request->nif)->first()) {
            return "true";
        }
        return "false";
    }
}
