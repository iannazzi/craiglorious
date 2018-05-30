<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payment', function (Blueprint $table) {
            $table->integer('bill_id')->unsigned()->index();
            $table->integer('payment_id')->unsigned()->index();
            $table->decimal('applied_amount', 20, 5);
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
        Schema::drop('bill_payment');
    }
}
