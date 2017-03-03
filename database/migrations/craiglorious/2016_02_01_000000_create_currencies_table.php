<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('currency_id');
            $table->enum('is_default', array('Yes','No'))->default('No');
            $table->string('title', 100)->default('');
            $table->string('code', 100)->default('');
            $table->string('symbol_left', 100)->default('');
            $table->string('symbol_right', 100)->default('');
            $table->boolean('decimal_places')->default(2);
            $table->decimal('exchange_rate', 20, 10)->default(1.0000000000);
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
        Schema::drop('currencies');
    }
}
