<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unsigned()->unique();
            $table->string('name');
            $table->enum('type', array('CURRENT ASSETS','LONG-TERM ASSETS','OTHER ASSETS','CURRENT LIABILITIES','LONG-TERM LIABILITIES','EQUITY','REVENUE','COST OF GOODS SOLD','EXPENSE'));
            $table->enum('sub_type', array('Not Specified','Other','Cash','Receivables','Investments','Buildings','Land','Equipment','Vehicles','Inventory','Payables','Notes','Loans','Mortgages'));
            $table->boolean('active');
            $table->boolean('required');
            $table->text('comments')->nullable();
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
        Schema::drop('chart_of_accounts');
    }
}
