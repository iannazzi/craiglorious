<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSalesInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_sales_invoice', function (Blueprint $table) {
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('customer_payment_id')->unsigned();
            $table->decimal('applied_amount', 20, 5);
            $table->text('applied_comments')->nullable();
            
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
        Schema::drop('payment_sales_invoice');
    }
}
