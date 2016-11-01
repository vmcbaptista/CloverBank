<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('current_account_id')->unsigned();
            $table->integer('product_saving_id')->unsigned();
            $table->timestamps();

            $table->foreign('current_account_id')->references('id')->on('current_account')->onDelete('no action')->onUpdate('no action');
            $table->foreign('product_saving_id')->references('id')->on('product_saving')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('savings', function (Blueprint $table) {
            $table->dropForeign(['current_account_id']);
            $table->dropForeign(['product_saving_id']);
        });

        Schema::drop('savings');
    }
}