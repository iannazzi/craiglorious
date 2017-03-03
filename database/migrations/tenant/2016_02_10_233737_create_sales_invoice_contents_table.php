<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id')->unsigned()->index();
            $table->integer('row_number');
            $table->integer('return_content_id')->unsigned()->index();
            $table->enum('content_type', array('PRODUCT','SERVICE','CREDIT_CARD','SHIPPING'))->default('PRODUCT');
            $table->integer('store_credit_id')->unsigned()->index();
            $table->integer('product_sub_id')->unsigned()->index();
            $table->string('barcode', 64);
            $table->string('checkout_description');
            $table->string('color_name', 100);
            $table->string('title', 100);
            $table->string('size', 30);
            $table->string('brand_name', 64);
            $table->string('style_number', 20);
            $table->string('color_code', 20);
            $table->decimal('retail_price', 20, 5);
            $table->decimal('sale_price', 20, 5);
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->integer('local_tax_jurisdiction_id')->unsigned();
            $table->integer('local_regular_sales_tax_rate_id');
            $table->integer('local_exemption_sales_tax_rate_id');
            $table->decimal('local_regular_tax_rate', 20, 5);
            $table->decimal('local_exemption_tax_rate', 20, 5);
            $table->decimal('local_exemption_value', 20, 5);
            $table->integer('state_tax_jurisdiction_id')->unsigned();
            $table->integer('state_regular_sales_tax_rate_id')->unsigned();
            $table->integer('state_exemption_sales_tax_rate_id')->unsigned();
            $table->decimal('state_regular_tax_rate', 20, 5);
            $table->decimal('state_exemption_tax_rate', 20, 5);
            $table->decimal('state_exemption_value', 20, 5);
            $table->decimal('tax_rate', 20, 5);
            $table->decimal('tax_total', 20, 5);
            $table->decimal('discount', 20, 5);
            $table->integer('discount_id')->unsigned()->index();
            $table->enum('discount_type', array('PERCENT','DOLLAR'));
            $table->decimal('applied_instore_discount', 20, 5);
            $table->integer('quantity');
            $table->decimal('extension', 20, 5);
            $table->integer('special_order_id');
            $table->integer('alteration_id')->unsigned()->index();
            $table->boolean('special_order');
            $table->boolean('paid');
            $table->boolean('ship');
            $table->text('promotion_id')->nullable();
            $table->boolean('wish_list');
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
        Schema::drop('sales_invoice_contents');
    }
}
