<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('image_path');
            $table->integer('nif')->unique();
            $table->timestamp('last_login');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('current_account', function (Blueprint $table) {
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign(['manager_id']);
        });

        Schema::drop('managers');
    }
}