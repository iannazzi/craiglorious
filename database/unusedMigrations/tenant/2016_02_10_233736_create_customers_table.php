<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('first_name', 30);
            $table->string('last_name', 40);
            $table->integer('billing_address_id')->unsigned()->index();
            $table->string('emails',255);
            $table->string('phone', 20);
            $table->text('comments')->nullable();
            $table->string('status');
            $table->integer('active');
            
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
        Schema::drop('customers');
    }
}
