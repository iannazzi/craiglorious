<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_contents', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('payroll_period_id')->unsigned()->index();
            $table->integer('employee_id');
            $table->text('comments');
            //$table->dateTime('start');
            //$table->dateTime('end');
            $table->decimal('regular_hours', 20, 5);
            $table->decimal('overtime_hours', 20, 5);
            $table->decimal('overtime_rate', 20, 5);
            $table->decimal('pre_tax_deductions', 20, 5);
            $table->decimal('post_tax_deductions', 20, 5);
            $table->decimal('pay_rate', 20, 5);
            $table->boolean('single');
            $table->integer('withholding_allowance');
            $table->decimal('medicaide_tax', 20, 5);
            $table->decimal('fica_tax', 20, 5);
            $table->decimal('federal_withholding', 20, 5);
            $table->decimal('state_withholding', 20, 5);
            $table->integer('state_id')->unsigned()->index();
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
        Schema::drop('payroll_contents');
    }
}
