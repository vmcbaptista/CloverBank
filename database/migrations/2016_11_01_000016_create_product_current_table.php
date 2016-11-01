<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_current', function (Blueprint $table) {
            $table->increments('id');
            $table->double('maintenance_costs');
            $table->integer('product_id')->unsigned();
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('current_account', function (Blueprint $table) {
            $table->foreign('product_current_id')->references('id')->on('product_current')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_current', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });


        Schema::table('current_account', function (Blueprint $table) {
            $table->dropForeign(['product_current_id']);
        });

        Schema::drop('product_current');
    }
}