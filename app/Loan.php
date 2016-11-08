<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan';

    /**
     * The account of this loan
     */
    public function currentAccount()
    {
        return $this->belongsTo('App\CurrentAccount','current_account_id');
    }

    /**
     * Each loan has is parent product
     */
    public function loanProduct()
    {
        return $this->belongsTo('App\ProductLoan','product_loan_id');
    }
}
