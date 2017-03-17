<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_lookup', function (Blueprint $table) {
            $table->integer('promotion_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_category_id');
            $table->boolean('include_subcategories');
            $table->integer('brand_id')->unsigned()->index();
            $table->enum('include_product', array('INCLUDE','EXCLUDE'));
            $table->enum('include_brand', array('INCLUDE','EXCLUDE'));
            $table->enum('include_category', array('INCLUDE','EXCLUDE'));
            
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
        Schema::drop('promotion_lookup');
    }
}
