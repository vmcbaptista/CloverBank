<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLoan extends Model
{
    protected $table = 'product_loan';

    #One loan product only extends from one product
    public function belongsTOne_product(){
       return $this->hasOne('App\Product');
    }
}
