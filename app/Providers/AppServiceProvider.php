<?php

namespace App\Providers;

use App\CurrentAccount;
use App\ProductSaving;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\ProductCurrent;
use App\ProductLoan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Creates custom validators to use with Laravel validations
        // The validators check if the ammounts introduced by the user when creating
        // accounts satisfy the conditions of it
        Validator::extend('amount_current_conditions', function($attribute, $value, $product, $validator) {
            $productCurrent = ProductCurrent::find($product[0]);
            $initialAmount = $value;
            $product = $productCurrent->belongsTOne_product()->first();
            if ($initialAmount < $product->min_amount)
            {
                return false;
            }
            return true;
        });
        Validator::extend('amount_loan_conditions', function($attribute, $value, $product, $validator) {
            $loan = ProductLoan::find($product[0]);
            $initialAmount = $value;
            $product = $loan->belongsTOne_product()->first();
            if ($initialAmount < $product->min_amount || $initialAmount > $loan->max_amount)
            {
                return false;
            }
            return true;
        });
        Validator::extend('amount_saving_conditions', function($attribute, $value, $product, $validator) {
            $saving = ProductSaving::find($product[0]);
            $initialAmount = $value;
            $product = $saving->belongsTOne_product()->first();
            if ($initialAmount < $product->min_amount || $initialAmount > $saving->max_amount)
            {
                return false;
            }
            return true;
        });
        Validator::extend('amount_balance', function($attribute, $value, $account, $validator) {
            $currentAccount = CurrentAccount::find($account[0]);
            $initialAmount = $value;
            if ($initialAmount > $currentAccount->balance)
            {
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local')
        {
            $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
        }
    }
}
