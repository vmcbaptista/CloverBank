<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCurrent extends Model
{
    protected $table = 'product_current';

    #One current product only extends from one product
    public function belongsTOne_product(){
      return $this->belongsTo('App\Product', 'product_id');
    }

    /**
     * Each product currents has many current accounts
     */
    public function currentAccount()
    {
        return $this->hasMany('App\CurrentAccount');
    }

}
