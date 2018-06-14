<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_periods', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('eftps_deposit', 20, 5);
            $table->string('eftps_confirmation');
            $table->string('comments');
            $table->timestamps();
//            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payroll_periods');
    }
}
