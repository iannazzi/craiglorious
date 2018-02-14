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
            $table->integer('employee_id')->nullable();
            $table->string('title');
            $table->text('comments');
            $table->boolean('all_day')->default(false);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('url');
            $table->string('class_name');
            $table->boolean('editable')->default(1);
            $table->boolean('start_editable')->default(1);
            $table->boolean('duration_editable')->default(1);
            $table->boolean('resource_editable')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
