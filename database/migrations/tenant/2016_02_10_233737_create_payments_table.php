<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('source_journal', array('GENERAL JOURNAL','PURCHASES JOURNAL','SALES JOURNAL'));
            $table->string('reference_id', 64);
            $table->integer('store_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('account_id')->unsigned()->index();
            $table->integer('payee_account_id')->unsigned()->index();
            $table->integer('manufacturer_id')->unsigned()->index();
            $table->date('payment_date');
            $table->dateTime('post_date');
            $table->dateTime('payment_entry_date');
            $table->decimal('payment_amount', 20, 5);
            $table->enum('payment_status', array('COMPLETE','PENDING','SCHEDULED'));
            $table->enum('applied_status', array('APPLIED','PARTIAL','UNAPPLIED','OVER APPLIED'));
            $table->boolean('validated');
            $table->boolean('post_validated');
            $table->text('comments')->nullable();
            $table->binary('binary_content', 16777215);
            $table->string('file_name');
            $table->string('file_type', 40);
            $table->integer('file_size');
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
        Schema::drop('payments');
    }
}
