<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('');
            $table->string('orgazation_type')->default('');
            $table->string('industry_type')->default('');
            $table->string('base_currency')->default('');

            $table->string('ein')->default('');
            $table->enum('tax_bases', array('None', 'Cash', 'Accrual'))->default('Cash');

            $table->string('email')->default('');
            $table->string('phone', 32)->default('');
            $table->string('fax', 32)->default('');
            $table->string('website', 30);
            $table->date('year_end');

            $table->datetime('lock_date');

            $table->integer('physical_address_id')->index()->unsigned();
            $table->integer('billing_address_id')->index()->unsigned();

            $table->string('comments', 64)->default('');
            $table->timestamps();
            $table->foreign('physical_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('billing_address_id')->references('id')->on('addresses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company');
    }
}
