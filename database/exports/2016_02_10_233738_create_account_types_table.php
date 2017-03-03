<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('default_chart_of_account_id')->unsigned();
            $table->enum('type', array('ASSETS','LIABILITY','EQUITY','NONE'));
            $table->string('name', 48)->unique();
            $table->integer('Priority');
            $table->string('caption');
            $table->text('description')->nullable();
            //$table->string('account_type_code', 10);
            $table->boolean('active');
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
        Schema::drop('account_types');
    }
}
