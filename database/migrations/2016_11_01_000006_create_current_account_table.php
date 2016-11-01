<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->double('balance');
            $table->integer('product_current_id')->unsigned();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('account_movements', function (Blueprint $table) {
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
        Schema::table('current_account', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });


        Schema::table('account_movements', function (Blueprint $table) {
            $table->dropForeign(['current_account_id']);
        });

        Schema::drop('current_account');
    }
}