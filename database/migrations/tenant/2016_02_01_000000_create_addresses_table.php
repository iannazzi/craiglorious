<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('to', 40);
            $table->string('address1', 40);
            $table->string('address2', 40);
            $table->string('city', 40);
            $table->string('state', 40);
            $table->string('zip', 20);
            $table->string('country', 40);
            $table->string('email', 255)->default('');
            $table->integer('state_id')->unsigned()->index()->nullable();
            $table->string('phone', 32)->default('');
            $table->string('fax', 32)->default('');
            $table->text('comments')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::drop('addresses');
    }
}
