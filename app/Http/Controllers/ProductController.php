<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use App\ProductCurrent;
use App\ProductLoan;
use App\ProductSaving;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;


class ProductController extends Controller
{
    public function renderForm(){
        $success = false;
        return view('manager.create_product',compact('success'));
    }

    /**
     * This methid will create a product from a sepecified type
     * It makes use of transactions
     * @param Request $request ->Request object brings everything sent after a submission
     */
    public function create(Request $request)
    {
        $this->validation($request);
        #Transaction Start
        DB::transaction(function () use ($request) {
            $product = new Product();
            $product->name = $request->name;
            $product->access_condition = $request->access_condition;
            $product->description = $request->description;
            $product->min_amount = $request->min_amount;
            $product->prod_type = $request->prod_type;
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
        $success = true;
        return view('manager.create_product',compact('success'));
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

    /**
     * Returns all the Products available in the bank
     * @param Request $request
     * @return mixed
     */
    public function getProduct(Request $request)
    {
        return Product::findOrFail($request->id);
    }

    /**
     * Returns all the current account products available in the bank
     * @param Request $request
     * @return mixed
     */
    public function getCurrent()
    {
        return ProductCurrent::all();
    }

    /**
     * Returns all the loan products available in the bank
     * @param Request $request
     * @return mixed
     */
    public function getLoan()
    {
        return ProductLoan::all();
    }

    /**
     * Returns all the savings account products available in the bank
     * @param Request $request
     * @return mixed
     */
    public function getSaving()
    {
        return ProductSaving::all();
    }

    /**
     * Returns all the products of the bank
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProducts()
    {
        return Product::all();
    }

    /**
     * Returns a view of all current accounts of the bank
     * @return $this
     */
    public function presentCurrentAccountProducts()
    {
        $currents = $this->getCurrent();
        $products = $this->getProducts();
        return view('products.current_accounts')->with('currents',$currents)->with('products',$products);
    }

    /**
     * Returns a view of all savings accounts of the bank
     * @return $this
     */
    public function presentSavingsAccountProducts()
    {
        $savings = $this->getSaving();
        $products = $this->getProducts();
        return view('products.savings_accounts')->with('savings',$savings)->with('products',$products);
    }

    /**
     * Returns a view of all loans accounts of the bank
     * @return $this
     */
    public function presentLoansAccountProducts()
    {
        $loans = $this->getLoan();
        $products = $this->getProducts();
        return view('products.loans_accounts')->with('loans',$loans)->with('products',$products);
    }

    /**
     * Validates the data introduced by the user when creating a new product using
     * Laravel validations
     * @param Request $request
     */
    public function validation(Request $request)
    {
        $conditions = [
            'name' => 'required|string',
            'description' => 'required|string',
            'access_condition' => 'required|string',
            'min_amount' => 'required|numeric'
        ];
        if ($request->prod_type == 'loan') {
            $conditions ["max_amount"] = 'required|numeric';
            $conditions ["rate"] = 'required|numeric';
            $conditions ["spread"] = 'required|numeric';
            $conditions ["IPC_tax"] = 'required|numeric';
            $conditions ["duration"] = 'required|integer';
        }
        else if ($request->prod_type == 'saving') {
            $conditions ["max_amount"] = 'required|numeric';
            $conditions ["tanb"] = 'required|numeric';
            $conditions ["BS_tax"] = 'required|numeric';
            $conditions ["reinforcements"] = 'required';
            $conditions ["duration"] = 'required|integer';
        }
        else {
            $conditions ["maint_costs"] = 'required|numeric';
        }
        $this->validate($request, $conditions);
    }
}
