<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSaving extends Model
{
    protected $table = 'product_saving';

    #One saving product only extends from one product
    public function belongsTOne_product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    /**
     * Each saving product as many saving accounts
     */
    public function savings(){
        return $this->hasMany('App\Savings');
    }
}
