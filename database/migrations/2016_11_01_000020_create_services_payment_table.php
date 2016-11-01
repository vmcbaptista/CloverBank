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
            $table->string('entity');
            $table->string('reference');
            $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('services_payment_id')->references('id')->on('services_payment')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['services_payment_id']);
        });

        Schema::drop('services_payment');
    }
}