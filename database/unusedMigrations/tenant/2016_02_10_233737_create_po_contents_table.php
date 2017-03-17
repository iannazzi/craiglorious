<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_id')->unsigned()->default(0)->index();
            $table->integer('poc_row_number')->unsigned();
            $table->string('size_row', 12);
            $table->string('size_column', 3);
            $table->string('style_number', 64);
            $table->string('style_number_source', 10);
            $table->string('color_code', 64);
            $table->string('color_description');
            $table->string('title');
            $table->integer('product_category_id')->index();
            $table->string('cup', 10);
            $table->string('inseam', 10);
            $table->text('attributes')->nullable();
            $table->string('size');
            $table->decimal('cost', 20, 5);
            $table->decimal('retail', 20, 5);
            $table->decimal('discount', 20, 5);
            $table->integer('discount_quantity');
            $table->integer('product_sku_id')->unsigned()->index();
            $table->integer('quantity_ordered')->default(0);
            $table->decimal('adjustment_quantity', 20, 5);
            $table->integer('quantity_received');
            $table->integer('quantity_missing');
            $table->integer('quantity_canceled');
            $table->integer('quantity_added');
            $table->integer('quantity_damaged');
            $table->integer('quantity_returning');
            $table->text('returning_comments')->nullable();
            $table->text('received_date_qty')->nullable();
            $table->text('comments')->nullable();
            $table->text('receive_comments')->nullable();
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
        Schema::drop('po_contents');
    }
}
