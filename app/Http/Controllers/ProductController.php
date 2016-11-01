<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Product;

class ProductController extends Controller
{
    public function renderForm(){
        return view('create_product');
    }

    public function create(Request $request){

        $product = new Product();
        $product->name = $request->name;
        $product->access_condition = $request->access_condition;
        $product->description = $request->description;
        $product->min_amount = $request->min_amount;
        $product->prod_type = $request->prod_type;
        $product->bank_state_tax = $request->BS_tax;
       if($product->prod_type = "loan"){
            $product->max_amount = $request->max_amount;
            $product->spread = $request->spread;
            $product->tan = $request->rate;
        }else{
            $product->max_amount = $request->max_amount;
            $product->tanb = $request->tanb;
            $product->tanl = $this->calculate_tanl($request->tanb, $request->BS_tax);
            $product->reinforcements = $request->reinforcements;
            $product->duration = $request->duration;
        }
        $product->save();
        //return view('create_product');
    }

    /**
     * calculate_tanl
     * This method will calculate the tanl (anual nominal liquid tax)
     * @param $tanb
     * @param $retFont
     * @return mixed
     */
    private function calculate_tanl($tanb, $retFont){
        return $tanb * (100 - $retFont);
    }

    private function calculate_taeg($tan, $taxes){

    }

}
