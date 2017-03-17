<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoReceiveEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_receive_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('terminal_id')->unsigned()->index();
            $table->integer('store_id')->unsigned()->index();
            $table->dateTime('receive_date');
            $table->string('pick_ticket', 40);
            $table->text('comments')->nullable();
            $table->text('wrong_items_comments')->nullable();
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
        Schema::drop('po_receive_events');
    }
}
