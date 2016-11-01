<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_loan', function (Blueprint $table) {
            $table->increments('id');
            $table->double('tanl');
            $table->double('spread');
            $table->double('max_amount');
            $table->double('taeg');
            $table->integer('duration');
            $table->integer('product_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('loan', function (Blueprint $table) {
            $table->foreign('product_loan_id')->references('id')->on('product_loan')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_loan', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });


        Schema::table('loan', function (Blueprint $table) {
            $table->dropForeign(['product_loan_id']);
        });

        Schema::drop('product_loan');
    }
}