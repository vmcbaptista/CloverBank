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
     * Create a new client
     * @param $clientData the data of the client that is sent through a AJAX request
     * @return mixed
     */
    public static function add($clientData)
    {
        $client = new Client();
        $username = explode(" ",$clientData->name);
        var_dump($username);
        $username = end($username)[0];
        $username .=substr($clientData->name,0,2);
        $username .= $clientData->nif;
        $nomeClient = $clientData->name;
        $password = str_random(8);
        $mail = $clientData->email;

        $client->name = $clientData->name;
        $client->email = $clientData->email;
        $client->address = $clientData->address;
        $client->phone = $clientData->phone;
        $client->nif = $clientData->nif;
        $client->username = $username;
        $client->password = bcrypt($password);
        $client->save();
        Mail::to($mail)->send(new SendLoginInfo($username,$password,$nomeClient));
        return $client->id;
    }

    /**
     * Returns the client with a specific NIF
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        return Client::where('nif', '=', $request->nif)->firstOrFail();
    }

    public function checkNif(Request $request)
    {
        if (!Client::where('nif', '=', $request->nif)->first()) {
            return "true";
        }
        return "false";
    }
}
