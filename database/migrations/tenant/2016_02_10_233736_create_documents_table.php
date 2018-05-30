<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_for_entry_lock')->unsigned()->index();
            $table->string('document_name');
            $table->date('document_date');
            $table->integer('user_id')->unsigned();
            $table->text('document_text')->nullable();
            $table->text('auto_save_document_text')->nullable();
            $table->text('comments')->nullable();
            $table->text('document_overview')->nullable();
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
        Schema::drop('documents');
    }
}
