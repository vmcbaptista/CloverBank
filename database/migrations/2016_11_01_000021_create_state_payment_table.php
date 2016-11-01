<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference');
            $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('state_payment_id')->references('id')->on('state_payment')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('account_movements', function (Blueprint $table) {
            $table->dropForeign(['state_payment_id']);
        });

        Schema::drop('state_payment');
    }
}