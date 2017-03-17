<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTaxCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_tax_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax_category_name', 80);
            $table->integer('tax_exempt');
            $table->integer('active');
            $table->timestamps();
        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('sales_tax_categories'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_tax_categories');
    }
}
