<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;
use App\ClientType;

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
        $client->name = $clientData->name;
        $client->address = $clientData->address." ".$clientData->numPort." ".$clientData->zip1." - ".$clientData->zip2." ".$clientData->zipLoc." ";
        $client->nif = $clientData->nif;
        $client->phone = $clientData->phone;
        $client->email = $clientData->email;
        $client->client_type_id = $clientData->type;
        $client->save();
        return json_encode(array("id" => $client->id, "name" => $client->name));
    }

    public function search(Request $request)
    {
        return Client::where('nif', '=', $request->nif)->firstOrFail();
    }
}
