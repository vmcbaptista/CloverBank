<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNetwork extends Model
{
    protected $table = 'phone_network';

    /**
     * Each service payment is related with a movement
     */
    public function account_movement()
    {
        return $this->belongsTo('App\AccountMovement','account_movements_id');
    }
}
