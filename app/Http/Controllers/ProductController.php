<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCurrent;
use App\ProductLoan;
use App\ProductSaving;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function renderForm(){
        return view('manager.create_product');
    }

    /**
     * This methid will create a product from a sepecified type
     * It makes use of transactions
     * @param Request $request ->Request object brings everything sent after a submission
     */
    public function create(Request $request)
    {
        #Transaction Start
        DB::transaction(function () use ($request) {
            $product = new Product();
            $product->name = $request->name;
            $product->access_condition = $request->access_condition;
            $product->description = $request->description;
            $product->min_amount = $request->min_amount;
            $product->prod_type = $request->prod_type;
             #TODO FINISH THE FORMULAS TO CALCULATE EVERYTHING TAXES
            $product->save();
            if ($product->prod_type == "loan") {
                $loan = new ProductLoan();
                $loan->max_amount = $request->max_amount;
                $loan->duration =  $request->duration;
                $loan->spread = $request->spread;
                $loan->comissions_impost = $request->IPC_tax;
                $loan->tanl = $request->rate;



                $product->products_type_loan()->save($loan);
            } else if ($product->prod_type == "saving") {
                $saving = new ProductSaving();
                $saving->max_amount = $request->max_amount;
                $saving->tanb = $request->tanb;
                $saving->tanl = $this->calculate_tanl($request->tanb, $request->BS_tax);
                $saving->reinforcements = $request->reinforcements;
                $saving->bank_state_tax = $request->BS_tax;
                $saving->duration = $request->duration;

                $product->products_type_saving()->save($saving);
            } else {
                $current = new ProductCurrent();
                $current->maintenance_costs = $request->maint_costs;

                $product->products_type_current()->save($current);
            }
        });


    }

    /**
     * Auxiliar method to calculate the TANL
     * @param $tanb
     * @param $retFont
     * @return mixed
     */
    private function calculate_tanl($tanb, $retFont){
        return $tanb * (100 - $retFont);
    }

    public function getProduct(Request $request)
    {
        return Product::findOrFail($request->id);
    }

    public function getCurrent()
    {
        return ProductCurrent::all();
    }

    public function getLoan()
    {
        return ProductLoan::all();
    }

    public function getSaving()
    {
        return ProductSaving::all();
    }
}
