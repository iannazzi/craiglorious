<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatePayrollTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_payroll_tax', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('state_id');
            $table->integer('year');
            $table->decimal('medicaide', 20, 5);
            $table->decimal('fica', 20, 5);
            $table->json('withholding');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('state_payroll_tax');
    }
}
