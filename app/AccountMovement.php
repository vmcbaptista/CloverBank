<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountMovement extends Model
{
    /**
     * Each movement is related with an account
     */
    public function currentAccount()
    {
        return $this->belongsTo('App\CurrentAccount','current_account_id');
    }

    /**
     * A movement could be a service payment
     */
    public function services_payment()
    {
        return $this->hasOne('App\ServicesPayment','account_movements_id');
    }
}
