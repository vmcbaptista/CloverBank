<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_network', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_movements_id')->unsigned();
            $table->foreign('account_movements_id')->references('id')->on('account_movements')->onDelete('no action')->onUpdate('no action');
            $table->string('entity');
            $table->integer('phone_number')->nullable()->default(NULL);
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
        Schema::drop('phone_network');
    }
}