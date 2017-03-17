<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->integer('id');
            $table->string('zip_code', 12);
            //$table->string('type', 20);
            $table->string('primary_city', 40);
            $table->text('acceptable_cities')->nullable();
            //$table->text('unacceptable_cities')->nullable();
            $table->string('state', 10);
            $table->integer('state_id')->unsigned()->index();
            $table->string('county', 100);
            $table->integer('county_id')->unsigned()->index();
            $table->string('timezone', 100);
            //$table->string('area_codes', 100);
            $table->decimal('latitude', 20, 5);
            $table->decimal('longitude', 20, 5);
            //$table->string('world_region', 10);
            $table->string('country', 20);
            //$table->integer('decommissioned');
            //$table->integer('estimated_population');
            //$table->text('notes')->nullable();
            $table->timestamps();
            //dont have all the states provinces in zip codes.... $table->foreign('state_id')->references('id')->on('states');
            // dont have all the counties in counties   $table->foreign('county_id')->references('id')->on('counties');


        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('zip_codes'));

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zip_codes');
    }
}
