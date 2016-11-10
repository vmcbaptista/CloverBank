<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesPayment extends Model
{
    protected $table = 'services_payment';

    protected $fillable = ['entity', 'reference'];

    /**
     * Each service payment is related with a movement
     */
    public function account_movement()
    {
        return $this->belongsTo('App\AccountMovement','account_movements_id');
    }
}
