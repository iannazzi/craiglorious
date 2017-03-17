<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkuSalePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sku_sale_prices', function (Blueprint $table) {
            $table->integer('product_sku_id');
            $table->string('sale_barcode', 40);
            $table->integer('price_level');
            $table->decimal('price', 20, 5);
            $table->string('title');
            $table->boolean('as_is');
            $table->boolean('clearance');
            $table->text('comments')->nullable();
            $table->unique(['product_sku_id','price_level'],'product_sku_id');
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
        Schema::drop('product_sku_sale_prices');
    }
}
