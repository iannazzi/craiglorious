<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('product_skus', function ($table) {
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('product_skus', function ($table)
//        {
//            $table->dropForeign('product_skus_product_id_foreign');
//        });

    }
}
