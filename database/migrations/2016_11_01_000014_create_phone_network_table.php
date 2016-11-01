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
            $table->string('entity');
            $table->integer('phone_number')->nullable()->default(NULL);
            $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('phone_network_id')->references('id')->on('phone_network')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['phone_network_id']);
        });

        Schema::drop('phone_network');
    }
}