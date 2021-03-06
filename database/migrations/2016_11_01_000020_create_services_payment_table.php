<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_movements_id')->unsigned();
            $table->foreign('account_movements_id')->references('id')->on('account_movements')->onDelete('no action')->onUpdate('no action');
            $table->string('entity');
            $table->string('reference');
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
        Schema::drop('services_payment');
    }
}