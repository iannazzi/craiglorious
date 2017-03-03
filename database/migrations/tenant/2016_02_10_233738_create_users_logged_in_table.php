<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLoggedInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_logged_in', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->string('http_user_agent');
            $table->string('ip_address');
            $table->dateTime('last_accessed');
            $table->string('url');
            $table->string('unique_id');
            $table->integer('session_time_remaining');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_logged_in');
    }
}
