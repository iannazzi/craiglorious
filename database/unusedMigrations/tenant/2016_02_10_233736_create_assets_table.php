<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned()->index();
            $table->integer('parent_account_id')->unsigned()->index();
            $table->date('purchase_date');
            $table->date('warranty_expiration_date');
            $table->date('depreciation_start_date');
            $table->decimal('purchase_price', 20, 5);
            $table->decimal('rate', 20, 5);
            $table->decimal('effective_life_years', 20, 5);
            $table->string('type');
            $table->string('name');
            $table->string('number');
            $table->string('serial_number');
            $table->enum('depreciation_method', array('No Depreciation', 'Straight Line', 'Declining Balance','Declining Balance (150%)', 'Declining Balance (200%)', 'Full Depreciation at Purchase' ));
            $table->enum('averaging method', array('Full Month', 'Actual Days'));
            $table->text('description')->nullable();
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
        Schema::drop('assets');
    }
}
