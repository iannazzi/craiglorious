<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chart_of_accounts_id')->unsigned()->index();
            $table->integer('product_sub_id')->unsigned()->default(0)->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('store_id')->unsigned()->default(0)->index();
            $table->enum('inventory_type', array('Available','Committed','Distressed','Discarded'));
            $table->decimal('quantity', 20, 5);
            $table->integer('location_id')->unsigned()->index();
            $table->string('inventory_tracking_number');
            $table->decimal('value', 20, 5);
            $table->dateTime('inventory_date');
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
        Schema::drop('inventory_logs');
    }
}
