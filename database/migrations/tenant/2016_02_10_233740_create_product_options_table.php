<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_attribute_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('value', 255)->default('');
            //$table->string('option_code', 20);
            //$table->integer('sort_index');
            //$table->decimal('price_adjustment', 20, 5);
            //$table->boolean('unique_web_product');
            //$table->text('extra_tags')->nullable();
            //$table->boolean('active');
            //$table->text('comments')->nullable();
            $table->unique(['product_attribute_id','product_id','value'],'p_a_v');
            $table->timestamps();
            //$table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_options');
    }
}
