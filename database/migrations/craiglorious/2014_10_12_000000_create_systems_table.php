<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('db_host');
            $table->string('db_name');
            $table->string('db_user');
            $table->string('db_pass');
            $table->string('phone');
            $table->string('address');
            $table->boolean('active');
            $table->boolean('registered');
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
        Schema::drop('systems');
    }
}
