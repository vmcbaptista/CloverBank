<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 13/11/16
 * Time: 01:40
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class Transferences extends model
{
    protected $table = 'tranferences';

    /**
     * Each transference is related with a movement
     */
    public function account_movement()
    {
        return $this->belongsTo('App\AccountMovement','account_movements_id');
    }
}