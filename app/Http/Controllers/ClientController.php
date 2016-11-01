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

    public function add(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->address = $request->address." ".$request->numPort." ".$request->zip1." - ".$request->zip2." ".$request->zipLoc." ";
        $client->nif = $request->nif;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->client_type_id = $request->type;
        $client->save();
        return json_encode(array("id" => $client->id, "name" => $client->name));
    }

    public function search(Request $request)
    {
        return Client::where('nif', '=', $request->nif)->firstOrFail();
    }
}
