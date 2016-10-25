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
            $table->integer('product_id')->unsigned();
            $table->integer('current_account_id')->unsigned();
            $table->timestamp('duration');
	    $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('no action');
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
        Schema::table('savings', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['current_account_id']);
        });

        Schema::drop('savings');
    }
}
