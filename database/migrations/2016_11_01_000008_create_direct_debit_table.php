<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectDebitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_debit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_movements_id')->unsigned();
            $table->foreign('account_movements_id')->references('id')->on('account_movements')->onDelete('no action')->onUpdate('no action');
            $table->integer('entity');
            $table->integer('autorization');
            $table->double('max_amount');
            $table->timestamp('limit_date');
            $table->string('service_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('direct_debit');
    }
}