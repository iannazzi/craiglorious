<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('promotion_name');
            $table->string('promotion_code', 20);
            $table->enum('promotion_type', array('Pre Tax','Post Tax'));
            $table->dateTime('start_date');
            $table->dateTime('expiration_date');
            $table->decimal('promotion_amount', 20, 5);
            $table->enum('item_or_total', array('ITEM','TOTAL'));
            $table->boolean('blanket');
            $table->enum('percent_or_dollars', array('$','%'));
            $table->decimal('buy_x', 20, 5);
            $table->decimal('get_y', 20, 5);
            $table->decimal('expired_value', 20, 5);
            $table->decimal('qualifying_amount', 20, 5);
            $table->boolean('check_if_can_be_applied_to_sale_items');
            $table->boolean('check_if_can_be_applied_to_clearance_items');
            $table->boolean('active');
            $table->text('comments')->nullable();
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
        Schema::drop('promotions');
    }
}
