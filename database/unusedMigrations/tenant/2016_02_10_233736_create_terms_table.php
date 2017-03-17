<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');
            $table->string('name');


            $table->string('terms', 64)->default('');
            $table->integer('due_days')->nullable();
            $table->decimal('discount', 10, 5)->nullable();
            $table->decimal('interest_rate', 10, 5);

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
        Schema::drop('terms');
    }
}
