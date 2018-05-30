<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_gateway_id')->unsigned();
            $table->string('transaction_status', 40);
            $table->integer('account_id')->unsigned()->index();
            $table->integer('deposit_account_id')->unsigned()->index();
            $table->integer('customer_payment_method_id')->unsigned()->index();
            $table->integer('customer_payment_batch_id')->unsigned();
            $table->string('card_number', 25);
            $table->integer('store_credit_id')->unsigned()->index();
            $table->dateTime('date');
            $table->decimal('payment_amount', 20, 5);
            $table->string('reference_number', 40);
            $table->string('transaction_id', 40);
            $table->string('authorization_code', 40);
            $table->string('batch_id', 40);
            $table->string('payment_status', 20);
            $table->string('summary', 25);
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
        Schema::drop('customer_payments');
    }
}
