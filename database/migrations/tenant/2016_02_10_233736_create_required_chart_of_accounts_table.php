<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequiredChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('required_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chart_of_account_type_id')->unsigned()->index();
            $table->string('required_account_name');
            $table->string('required_account_code', 10);
            $table->integer('priority');
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
        Schema::drop('required_chart_of_accounts');
    }
}
