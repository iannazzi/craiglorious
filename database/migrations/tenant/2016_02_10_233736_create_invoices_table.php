<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('store_id')->unsigned()->index();
            $table->integer('vendor_id')->unsigned()->index();
            $table->enum('type', array('Receipt','Refund', 'Invoice', 'Credit'));
            $table->enum('status', array('OPEN','CLOSED'));
            $table->string('number', 48);
            $table->decimal('amount', 20, 5);
            $table->decimal('discount_available', 20, 5);
            $table->decimal('use_tax', 20, 5); //this amount is not on the bill.....
            $table->decimal('discount_lost', 20, 5);
            $table->date('invoice_date');
            $table->date('invoice_due_date');
            $table->string('supplier');
            $table->string('description');
            $table->text('comments')->nullable();
            $table->enum('payment_status', array('OVERPAID','PAID','UNPAID','USED','UNUSED'));
            $table->boolean('validated');
            $table->boolean('received')->default(1);
            $table->binary('binary_content');
            $table->string('file_name');
            $table->string('file_type', 40);
            $table->integer('file_size');
            $table->timestamps();
            $table->unique(['vendor_id','number'],'vendor_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('general_invoices');
    }
}
