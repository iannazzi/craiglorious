<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreCreditCardNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_credit_card_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number', 20)->unique();
            $table->dateTime('date_created');
            $table->dateTime('date_printed')->nullable();
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
        Schema::drop('store_credit_card_numbers');
    }
}
