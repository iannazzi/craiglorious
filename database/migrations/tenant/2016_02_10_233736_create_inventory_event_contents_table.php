<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryEventContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_event_contents', function (Blueprint $table) {
            $table->increments('inventory_event_content_id');
            $table->integer('inventory_event_id')->index();
            $table->string('barcode', 40);
            $table->integer('product_sub_id')->unsigned()->default(0)->index();
            $table->integer('price_level');
            $table->enum('inventory_type', array('Available','Committed','Distressed','Discarded'));
            $table->decimal('quantity', 20, 5);
            $table->string('inventory_tracking_number');
            $table->decimal('value', 20, 5);
            $table->decimal('storage_cost', 20, 5);
            $table->decimal('purchasing_cost', 20, 5);
            $table->dateTime('expiration_date');
            $table->string('lot_number');
            $table->enum('action', array('TRANSFER','PHYSICAL_COUNT','INVENTORY_ADJUSTMENT','CLEAR'));
            $table->text('comments')->nullable();
            $table->string('unique_tag', 20);
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
        Schema::drop('inventory_event_contents');
    }
}
