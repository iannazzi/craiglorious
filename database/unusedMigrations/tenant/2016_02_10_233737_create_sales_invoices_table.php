<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('return_invoice_id')->unsigned()->index();
            $table->integer('store_id')->unsigned()->index();
            $table->integer('terminal_id');
            $table->integer('chart_of_account_id')->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('sales_associate_id')->index();
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('user_id_for_entry_lock')->unsigned();
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('address_id')->index();
            $table->string('invoice_number', 11);
            $table->dateTime('invoice_date');
            $table->decimal('shipping_amount', 20, 5);
            $table->enum('tax_calculation_method', array('minimum','average','maximum'));
            $table->enum('invoice_status', array('INIT','DRAFT','OPEN','CLOSED','EXITED'));
            $table->enum('payment_status', array('PAID','UNPAID'));
            $table->boolean('follow_up');
            $table->boolean('special_order');
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
        Schema::drop('sales_invoices');
    }
}
