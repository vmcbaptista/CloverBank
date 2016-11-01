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
            $table->string('dest_name');
            $table->string('dest_iban');
            $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('tranferences_id')->references('id')->on('tranferences')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['tranferences_id']);
        });

        Schema::drop('tranferences');
    }
}