<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_entries', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->boolean('all_day');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('url');
            $table->string('class_name');
            $table->boolean('editable');
            $table->boolean('start_editable');
            $table->boolean('duration_editable');
            $table->boolean('resource_editable');
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
        Schema::drop('calendar_entries');
    }
}
