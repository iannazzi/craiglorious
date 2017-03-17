<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to_user_id')->unsigned()->index();
            $table->integer('from_user_id')->unsigned()->index();
            $table->text('message')->nullable();
            $table->text('action_url')->nullable();
            $table->text('response')->nullable();
            $table->dateTime('message_creation_date');
            $table->dateTime('message_complete_date');
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
        Schema::drop('messages');
    }
}
