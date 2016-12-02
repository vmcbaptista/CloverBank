<?php

namespace App;

use App\Notifications\ClientResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'name', 'email', 'password','address','nif','phone','accountState','username'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPassword($token));
    }

    /**
     * The current accounts of the client
     */
    public function accounts()
    {
        return $this->belongsToMany('App\CurrentAccount','current_account_has_client')->withTimestamps();
    }
}
