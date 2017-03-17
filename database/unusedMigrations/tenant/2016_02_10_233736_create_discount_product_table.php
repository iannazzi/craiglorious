<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_product', function (Blueprint $table) {
            $table->integer('discount_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('product_category_id')->unsigned();
            $table->unique(['discount_id','product_id','manufacturer_id','product_category_id'],'discount_id');
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
        Schema::drop('discount_product');
    }
}
