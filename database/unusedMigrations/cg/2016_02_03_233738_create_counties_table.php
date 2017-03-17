<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned()->index();
            $table->integer('tax_jurisdiction_id')->unsigned()->index();
            $table->string('name', 40);
            $table->timestamps();
            $table->foreign('tax_jurisdiction_id')->references('id')->on('tax_jurisdictions');
            $table->foreign('state_id')->references('id')->on('states');

        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('counties'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counties');
    }
}
