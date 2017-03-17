<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionProductSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_product_sku', function (Blueprint $table) {
            $table->integer('product_sku_id')->unsigned()->index();
            $table->integer('product_option_id')->unsigned()->index();
            //$table->unique(['product_sku_id','product_option_id'],'product_sku_id');
            $table->timestamps();
            $table->foreign('product_sku_id')->references('id')->on('product_skus')->onDelete('cascade');
            $table->foreign('product_option_id')->references('id')->on('product_options')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_option_product_sku');
    }
}
