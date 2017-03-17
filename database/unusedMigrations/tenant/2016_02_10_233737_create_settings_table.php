<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->enum('visible', array('Yes','No'))->default('Yes');
            $table->enum('input_type', array('TEXT','SELECT','CHECKBOX'));
            $table->string('group_name', 100)->default('');
            $table->integer('priority')->unsigned()->default(0);
            $table->string('name', 100)->default('')->primary();
            $table->text('value')->nullable();
            $table->text('value_text')->nullable();
            $table->text('options')->nullable();
            $table->string('default_value', 100)->default('');
            $table->string('validation', 100)->default('');
            $table->string('caption', 100)->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('settings');
    }
}
