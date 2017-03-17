<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxJurisdictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_jurisdictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id');
            $table->string('jurisdiction_name');
            $table->string('jurisdiction_code', 30);
            $table->decimal('default_tax_rate', 20, 5);
            $table->enum('local_or_state', array('Local','State'));
            $table->integer('active');
            $table->timestamps();
        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('tax_jurisdictions'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tax_jurisdictions');
    }
}
