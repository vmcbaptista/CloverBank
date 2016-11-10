<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_movements_id')->unsigned();
            $table->foreign('account_movements_id')->references('id')->on('account_movements')->onDelete('no action')->onUpdate('no action');
            $table->string('dest_name');
            $table->string('dest_iban');
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
        Schema::drop('tranferences');
    }
}