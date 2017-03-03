<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_vendor', function (Blueprint $table) {
            $table->integer('system_id')->unsigned()->index();
            $table->integer('view_id')->unsigned()->index();
            $table->unique(['system_id','view_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_view');
    }
}
