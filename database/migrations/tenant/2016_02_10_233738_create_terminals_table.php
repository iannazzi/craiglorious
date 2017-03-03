<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 16)->unique();

            $table->enum('status', array('open','closed','locked'));
            $table->text('description');
            $table->string('cookie_name', 30);
            $table->boolean('active');

            $table->string('ip_address', 30);
            $table->string('cash_drawer', 30);
            $table->integer('printer_id')->unsigned()->index();
            $table->integer('default_cash_account_id')->unsigned()->index();
            $table->integer('default_check_account_id')->unsigned()->index();
            $table->integer('default_gift_card_account_id')->unsigned();
            $table->integer('default_store_credit_account_id')->unsigned();
            $table->integer('default_prepay_account_id')->unsigned();
            $table->integer('default_non_payment_account_id')->unsigned()->index();
            $table->integer('payment_gateway_id');
            $table->integer('refund_checking_account_id');
            $table->decimal('max_cash_refund', 20, 5)->default(0.00000);

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
        Schema::drop('terminals');
    }
}
