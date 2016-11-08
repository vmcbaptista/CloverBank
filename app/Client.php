<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    /**
     * The current accounts of the client
     */
    public function accounts()
    {
        return $this->belongsToMany('App\CurrentAccount','current_account_has_client')->withTimestamps();
    }
}
