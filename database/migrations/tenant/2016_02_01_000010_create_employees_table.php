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
            $table->integer('user_id')->unsigned()->index();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('ss');
            $table->string('phone');
            $table->string('email', 64)->default('');

            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('zip');
            $table->integer('state_id')->unsigned()->index()->nullable();

            $table->decimal('pay_rate');
            $table->integer('withholding_allowance');


            $table->string('emergency_phone')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
