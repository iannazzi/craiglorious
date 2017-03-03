<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_for_entry_lock')->unsigned();
            $table->integer('manufacturer_id')->unsigned()->default(0)->index();
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->default(0)->index();
            $table->integer('store_id')->unsigned()->default(0)->index();
            $table->string('po_number')->default('');
            $table->string('manufacturer_po_number')->default('');
            $table->enum('po_type', array('ORDER','RETURN'));
            $table->dateTime('create_date')->default('0000-00-00 00:00:00');
            $table->dateTime('placed_date')->default('0000-00-00 00:00:00');
            $table->dateTime('status_date')->default('0000-00-00 00:00:00');
            $table->date('delivery_date')->default('0000-00-00');
            $table->date('cancel_date')->default('0000-00-00');
            $table->dateTime('received_date')->default('0000-00-00 00:00:00');
            $table->integer('receive_store_id')->unsigned()->index();
            $table->integer('receive_user_id')->unsigned()->index();
            $table->string('employee_po_creater_name', 64)->default('');
            $table->enum('po_status', array('INIT','DRAFT','PREPARED','OPEN','CLOSED','DELETED'))->default('INIT')->index();
            $table->enum('ordered_status', array('NOT SUBMITTED','SUBMITTED','EMAILED','MANUALLY SUBMITTED','CANCELED','REVISED'))->default('NOT SUBMITTED');
            $table->string('received_status');
            $table->enum('invoice_status', array('INCOMPLETE','COMPLETE','OVER APPLIED','NEED CREDIT MEMO','NEED TO RETURN GOODS'));
            $table->text('comments')->nullable();
            $table->string('po_title');
            $table->text('stored_size_chart')->nullable();
            $table->integer('wrong_items_qty')->default(0);
            $table->text('wrong_items_comments')->nullable();
            $table->text('log')->nullable();
            $table->integer('ra_required')->unsigned();
            $table->string('ra_number');
            $table->integer('credit_memo_required');
            $table->text('credit_memo_invoice_number')->nullable();
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
        Schema::drop('pos');
    }
}
