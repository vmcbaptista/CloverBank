<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable()->default(NULL);
            $table->string('amount')->nullable()->default(NULL);
            $table->integer('phone_network_id')->unsigned();
            $table->integer('tranferences_id')->unsigned();
            $table->integer('interbank_operation_id')->unsigned();
            $table->integer('direct_debit_id')->unsigned();
            $table->integer('state_payment_id')->unsigned();
            $table->integer('services_payment_id')->unsigned();
            $table->integer('current_account_id')->unsigned();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('account_movements');
    }
}