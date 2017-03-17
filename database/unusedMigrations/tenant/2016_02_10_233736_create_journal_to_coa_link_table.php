<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalToCoaLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_to_coa_link', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('Journal', array('Sales','Payroll','Purchases','Purchase Orders','Inventory'));
            $table->string('link_name');
            $table->string('comments');
            $table->integer('chart_of_accounts_id')->index();
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
        Schema::drop('journal_to_coa_link');
    }
}
