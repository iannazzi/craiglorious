<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_buys', function (Blueprint $table) {
            $table->integer('promotion_id')->unsigned()->index();
            $table->decimal('buy', 20, 5);
            $table->decimal('get', 20, 5);
            $table->decimal('discount', 20, 5);
            $table->enum('d_or_p', array('$','%'));
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
        Schema::drop('promotion_buys');
    }
}
