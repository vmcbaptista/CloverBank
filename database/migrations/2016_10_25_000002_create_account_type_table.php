<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->timestamps();        
	});

        Schema::table('account', function (Blueprint $table) {
            $table->foreign('account_type_id')->references('id')->on('account_type')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('account', function (Blueprint $table) {
            $table->dropForeign(['account_type_id']);
        });

        Schema::drop('account_type');
    }
}
