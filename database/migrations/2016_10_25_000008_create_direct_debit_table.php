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
            $table->integer('entity');
            $table->integer('autorization');
            $table->float('max_amount');
            $table->timestamp('limit_date');
            $table->string('service_type');
	        $table->timestamps();
        });

        Schema::table('account_movements', function (Blueprint $table) {
            $table->foreign('direct_debit_id')->references('id')->on('direct_debit')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['direct_debit_id']);
        });

        Schema::drop('direct_debit');
    }
}
