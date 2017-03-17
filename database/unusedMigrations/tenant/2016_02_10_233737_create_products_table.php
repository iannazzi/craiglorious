<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_category_id')->unsigned()->index();
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('brand_size_id')->unsigned()->index();
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->string('code', 64)->default('');
            $table->string('name')->default('');
            $table->string('type')->default('');
            $table->integer('preferred_vendor_id')->unsigned()->index();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->string('unit_of_measure')->default('EA');
            //$table->decimal('case_quantity', 20, 5);
            //$table->decimal('case_price', 20, 5);
            $table->decimal('retail_price', 20, 5)->unsigned()->default(0.00000);
            $table->decimal('sale_price', 20, 5)->unsigned()->default(0.00000);
            $table->decimal('weight', 10)->unsigned()->default(0.00);
            $table->text('comments')->nullable();
            $table->unique(['brand_id','code'],'brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::drop('products');
    }
}
