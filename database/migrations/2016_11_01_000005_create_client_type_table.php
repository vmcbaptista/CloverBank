<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();

        });

        Schema::table('client', function (Blueprint $table) {
            $table->foreign('client_type_id')->references('id')->on('client_type')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign(['client_type_id']);
        });

        Schema::drop('client_type');
    }
}