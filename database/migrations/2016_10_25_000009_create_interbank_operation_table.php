<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterbankOperationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interbank_operation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dest_name');
            $table->string('dest_iban');
            $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('interbank_operation_id')->references('id')->on('interbank_operation')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['interbank_operation_id']);
        });

        Schema::drop('interbank_operation');
    }
}
