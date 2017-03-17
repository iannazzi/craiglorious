<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //unique was style number, color code
        //JSON option:value,option:value etc
        //ex code:1234:description,color_code:2345:description,size:34:


        Schema::create('upcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->index();
            $table->string('upc_code', 64)->default('');
            $table->string('json_codes', 64)->default('');
            $table->string('style_number', 64)->default('');
            $table->string('style_description')->default('');
            $table->string('color_code', 64)->default('');
            $table->string('color_description', 64)->default('');
            $table->string('size', 64)->default('');
            $table->decimal('msrp', 20, 5)->unsigned()->default(0.00000);
            $table->decimal('cost', 20, 5)->unsigned()->default(0.00000);
            $table->string('comments')->default('');
            $table->unique(['vendor_id','upc_code'],'vendor_id');
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
        Schema::drop('upcs');
    }
}
