<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('access_codition');
            $table->string('description')->nullable();
            $table->float('interest_rate');
            $table->float('min_amount');
            $table->float('max_amount')->nullable();
            $table->float('tanb')->nullable();
            $table->float('tael')->nullable();
            $table->float('tanl')->nullable();
            $table->float('spread')->nullable();
            $table->float('tan')->nullable();
            $table->float('taeg')->nullable();
            $table->boolean('reinforcements');
            $table->string('prod_type');
            $table->timestamp('duration');
            $table->timestamps();
        });

        Schema::table('current_account', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('loan', function (Blueprint $table) {
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

        Schema::table('current_account', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('loan', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::drop('product');
    }
}
