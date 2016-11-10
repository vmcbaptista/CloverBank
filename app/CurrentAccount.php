<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAccount extends Model
{
    protected $table = 'current_account';

    /**
     * The clients of this account
     */
    public function clients()
    {
        return $this->belongsToMany('App\Client','current_account_has_client')->withTimestamps();
    }

    /**
     * Each current account has is parent product
     */
    public function currentProduct()
    {
        return $this->belongsTo('App\ProductCurrent','product_current_id');
    }

    /**
     * Each current account has is parent product
     */
    public function manager()
    {
        return $this->belongsTo('App\Manager','manager_id');
    }

    /**
     * Each current account has is parent product
     */
    public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id');
    }

    /**
     * Each account will have many movements
     */
    public function movements()
    {
        return $this->hasMany('App\AccountMovement','current_account_id');
    }
}
