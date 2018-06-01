<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFederalPayrollTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_payroll_tax', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->decimal('medicaide_rate', 20, 5);
            $table->decimal('fica_rate', 20, 5);
            $table->json('withholding', 20, 5);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('federal_payroll_tax');
    }
}
