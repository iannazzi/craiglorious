<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->string('barcode', 64)->default('');
            $table->string('service_name')->default('');
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->enum('unit_of_measure', array('EA','HOUR'));
            $table->decimal('retail_price', 20, 5)->unsigned()->default(0.00000);
            $table->decimal('cost', 20, 5)->unsigned()->default(0.00000);
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
        Schema::drop('services');
    }
}
