<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->unsigned()->default(0)->index();
            $table->integer('level')->unsigned()->default(0)->index();
            $table->smallInteger('priority')->unsigned()->default(5)->index();
            $table->integer('default_product_priority');
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->enum('is_visible', array('Yes','No'))->default('Yes');
            $table->enum('list_subcats', array('Yes','No'))->default('No');
            $table->string('url_hash', 32)->default('')->index();
            $table->string('url_default', 128)->default('');
            $table->string('url_custom', 128)->default('');
            $table->string('key_name')->default('');
            $table->string('category_header')->default('');
            $table->text('meta_keywords')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('name')->default('');
            $table->text('description')->nullable();
            $table->text('description_bottom')->nullable();
            $table->text('category_path')->nullable();
            $table->integer('active');
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
        Schema::drop('product_categories');
    }
}
