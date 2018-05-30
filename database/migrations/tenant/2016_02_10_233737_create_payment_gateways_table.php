<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('store_id')->unsigned()->index();
            $table->integer('account_id')->unsigned()->index();
            $table->integer('vendor_id')->unsigned()->index();
            $table->string('login_id');
            $table->string('transaction_key');
            $table->enum('gateway_provider', array('Physical Terminal','Authorize.net','Orbital','Square'));
            $table->string('model_name');
            $table->string('website_url');
            $table->string('user_name');
            $table->string('password');
            $table->enum('line', array('online','offline'));
            $table->boolean('online');
            $table->boolean('active');
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
        Schema::drop('payment_gateways');
    }
}
