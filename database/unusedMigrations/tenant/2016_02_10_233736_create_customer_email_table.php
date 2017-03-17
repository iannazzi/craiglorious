<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_email', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned();
            $table->integer('email_address_id')->unsigned();
            $table->unique(['customer_id','email_address_id'],'customer_id');
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
        Schema::drop('customer_email');
    }
}
