<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionSalesInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_sales_invoice', function (Blueprint $table) {
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('promotion_id')->unsigned();
            $table->decimal('applied_amount', 20, 5);
            $table->integer('row_number');
            
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
        Schema::drop('promotion_sales_invoice');
    }
}
