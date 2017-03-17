<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('image', 65535);
            $table->string('image_type');
            $table->string('original_image_name');
            $table->enum('view', array('FRONT','BACK','SIDE','TOP','BOTTOM'));
            $table->string('crop_coordinates');
            $table->string('web_url');
            $table->string('path');
            $table->boolean('active');
            $table->text('comments')->nullable();
            $table->dateTime('date_added');
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
        Schema::drop('product_images');
    }
}
