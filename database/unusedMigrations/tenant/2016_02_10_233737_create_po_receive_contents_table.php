<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoReceiveContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_receive_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_receive_event_id')->unsigned()->index();
            $table->integer('po_content_id')->unsigned()->index();
            $table->integer('received_quantity');
            $table->text('receive_comments')->nullable();
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
        Schema::drop('po_receive_contents');
    }
}
