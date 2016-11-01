<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCurrent extends Model
{
    protected $table = 'product_current';

    #One current product only extends from one product
    public function belongsTOne_product(){
      return $this->hasOne('App\Product');
    }

}
