<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSavingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_saving', function (Blueprint $table) {
            $table->increments('id');
            $table->double('tanb');
            $table->double('max_amount');
            $table->double('tanl');
            $table->boolean('reinforcements');
            $table->integer('duration');
            $table->double('bank_state_tax');
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_saving', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::drop('product_saving');
    }
}