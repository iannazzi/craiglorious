<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsBackupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_backup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id')->unsigned()->index();
            $table->string('document_name');
            $table->date('document_date');
            $table->integer('user_id')->unsigned();
            $table->text('document_text')->nullable();
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
        Schema::drop('documents_backup');
    }
}
