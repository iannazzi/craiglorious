<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoPurchaseInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_purchase_invoice', function (Blueprint $table) {
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
        Schema::drop('po_purchase_invoice');
    }
}
