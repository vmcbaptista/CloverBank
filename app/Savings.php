<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    protected $table = 'savings';

    /**
     * The account of this saving
     */
    public function currentAccount()
    {
        return $this->belongsTo('App\CurrentAccount','current_account_id');
    }

    /**
     * Each saving has is parent product
     */
    public function savingProduct()
    {
        return $this->belongsTo('App\ProductSaving','product_saving_id');
    }
}
