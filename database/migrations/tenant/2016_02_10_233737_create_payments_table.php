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
            $table->string('reference_id', 64);
            $table->integer('account_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->date('payment_date');
            $table->date('post_date');
            $table->date('payment_entry_date');
            $table->decimal('payment_amount', 20, 5);
            $table->enum('payment_status', array('COMPLETE','PENDING','SCHEDULED'));
            $table->enum('applied_status', array('APPLIED','PARTIAL','UNAPPLIED','OVER APPLIED'));
            $table->boolean('validated');
            $table->boolean('post_validated');
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
        Schema::drop('payments');
    }
}
