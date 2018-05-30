<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->string('barcode', 20);
            $table->string('carrier_name', 100)->default('');
            $table->string('method_name', 100)->default('');
            $table->boolean('priority')->default(0);
            $table->decimal('weight_min', 10)->default(0.00);
            $table->decimal('weight_max', 10)->default(1000.00);
            $table->decimal('fee', 20, 5)->default(0.00000);
            $table->enum('fee_type', array('amount','percent'))->default('amount');
            $table->boolean('active');
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
        Schema::drop('shipping_options');
    }
}
