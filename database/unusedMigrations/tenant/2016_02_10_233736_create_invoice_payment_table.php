<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_payment', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned()->index();
            $table->integer('payment_id')->unsigned()->index();
            $table->enum('source_journal', array('PURCHASES JOURNAL','GENERAL JOURNAL','SALES JOURNAL'));
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
        Schema::drop('invoice_payment');
    }
}
