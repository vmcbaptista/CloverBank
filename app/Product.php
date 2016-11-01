<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    #One product has many loan products
    public function products_type_loan(){
       return $this->hasMany('App\ProductLoan');
    }
    #One product has many current products
    public function products_type_current(){
       return  $this->hasMany('App\ProductCurrent');
    }
    #One product has many saving products
    public function products_type_saving(){
        return $this->hasMany('App\ProductSaving');
    }
}
