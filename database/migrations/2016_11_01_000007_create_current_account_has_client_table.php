<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentAccountHasClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_account_has_client', function (Blueprint $table) {
            $table->integer('current_account_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('password');
            $table->increments('pin');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('no action')->onUpdate('no action');
            $table->foreign('current_account_id')->references('id')->on('current_account')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('current_account_has_client', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['current_account_id']);
        });

        Schema::drop('current_account_has_client');
    }
}