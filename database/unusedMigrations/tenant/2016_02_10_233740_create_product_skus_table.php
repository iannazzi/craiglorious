<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            //$table->integer('product_color_id')->unsigned()->index();
            $table->boolean('active')->default(0);
            $table->integer('inventory_warning')->unsigned()->default(0);
            //$table->string('product_sku', 64)->default('');
            $table->string('upc', 64)->nullable()->unique();
            //$table->string('product_subid_name', 64)->default('')->unique();
            //$table->string('barcode', 40);
            //$table->string('attributes_hash')->default('');
            //$table->text('attributes_list')->nullable();
            //$table->text('comments')->nullable();
            $table->timestamps();
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
        Schema::drop('product_skus');
    }
}
