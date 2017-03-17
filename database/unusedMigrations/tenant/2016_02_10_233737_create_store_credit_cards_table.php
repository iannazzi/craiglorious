<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('card_number', 24)->unique();
            $table->enum('card_type', array('Gift Card','Store Credit','Deposit'));
            $table->dateTime('date_created');
            $table->dateTime('date_issued');
            $table->integer('customer_id')->unsigned()->index();
            $table->decimal('original_amount', 20, 5);
            $table->boolean('locked');
            $table->text('comments')->nullable();
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
        Schema::drop('store_credit_cards');
    }
}
