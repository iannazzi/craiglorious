<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditMemoInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_memo_invoice', function (Blueprint $table) {
            $table->integer('purchases_journal_invoice_id')->unsigned()->index();
            $table->integer('purchases_journal_credit_memo_id')->unsigned()->index();
            $table->decimal('applied_amount', 20, 5);
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
        Schema::drop('credit_memo_invoice');
    }
}
