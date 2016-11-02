<?php

namespace App\Http\Controllers;

use App\CurrentAccount;
use App\CurrentAccountHasClient;
use App\Loan;
use App\Savings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\ClientType;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function showForm(Request $request) {
        $client_types = ClientType::all();
        return view('account.formAdd',compact('client_types'));
    }

    public function add(Request $request)
    {
        DB::transaction(function () use($request) {
            $cliId = $request->clientId;
            if (empty ($cliId)) {
                $clientData = json_decode($request->cliData);
                $cli = ClientController::add($clientData);
                $cliId = json_decode($cli,true)["id"];
            }
            if ($request->prod_type == 1) {
                $currentAccount = new CurrentAccount();
                $currentAccount->product_current_id = $request->product;
                $currentAccount->balance = $request->amount;
                //TODO: Falta arranjar uma forma de introduzir o gestor e o balcão
                $currentAccount->manager_id = 1;
                $currentAccount->branch_id = 1;
                $currentAccount->save();
                $this->associateClientAccount($currentAccount->id, $cliId);

            } elseif ($request->prod_type == 2) {
                $saving = new Savings();
            } else {
                $loan = new Loan();
            }
        });
    }

    private function associateClientAccount($account,$client)
    {
        $assoc = new CurrentAccountHasClient();
        $assoc->client_id = $client;
        $assoc->current_account_id = $account;
        $assoc->save();
    }
}
