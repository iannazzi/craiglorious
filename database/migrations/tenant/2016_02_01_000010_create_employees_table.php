<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 24);
            $table->string('last_name', 36);
            $table->string('ss', 36);
            $table->text('address');
            $table->decimal('pay_rate');
            $table->integer('withholding_allowance');
            $table->string('phone');
            $table->string('email', 64)->default('');
            $table->string('emergency_phone');
            $table->string('emergency_contact');
            $table->boolean('active')->default(0);
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
        Schema::drop('employees');
    }
}
