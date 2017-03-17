<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesCreditMemoPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_credit_memo_po', function (Blueprint $table) {
            $table->integer('purchases_journal_id')->unsigned()->index();
            $table->integer('po_id')->unsigned()->index();
            $table->decimal('applied_amount', 20, 5);
            $table->text('comments')->nullable();
            $table->unique(['purchases_journal_id','po_id'],'purchases_journal_id');
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
        Schema::drop('purchases_credit_memo_po');
    }
}
