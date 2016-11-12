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
    public function addForm()
    {
        $client_types = ClientType::all();
        return view("client.add",compact('client_types'));
    }

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

    public function search(Request $request)
    {
        return Client::where('nif', '=', $request->nif)->firstOrFail();
    }
}
