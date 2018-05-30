<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('product_attribute_id')->unsigned()->index();
            $table->boolean('case_qty');
            $table->boolean('cup');
            $table->boolean('cup_required');
            $table->boolean('inseam');
            $table->boolean('width');
            $table->string('size_modifier', 20);
            $table->text('sizes')->nullable();
            $table->boolean('active');
            $table->string('comments')->default('');
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
        Schema::drop('brand_sizes');
    }
}
