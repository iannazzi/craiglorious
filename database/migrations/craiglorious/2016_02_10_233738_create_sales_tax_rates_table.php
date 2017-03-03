<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_tax_category_id')->unsigned()->index();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('tax_jurisdiction_id')->unsigned()->index();
            $table->string('sales_tax_name');
            $table->decimal('tax_rate', 20, 5);
            $table->enum('tax_type', array('Regular','Exemption'));
            $table->decimal('exemption_value', 20, 5);
            $table->timestamps();
        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('sales_tax_rates'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_tax_rates');
    }
}
