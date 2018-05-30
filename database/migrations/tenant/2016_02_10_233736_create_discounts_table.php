<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('discount_name');
            $table->string('discount_code', 20);
            $table->decimal('discount_amount', 20, 5);
            $table->enum('percent_or_dollars', array('$','%'));
            $table->decimal('max_discount', 20, 5);
            $table->boolean('active');
            $table->boolean('admin_only');
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
        Schema::drop('discounts');
    }
}
