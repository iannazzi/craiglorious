<?php

use App\Classes\Database\DatabaseCsvLoader;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('default_state_tax', 20, 5)->unsigned()->default(0.00000);
            $table->string('name')->default('');
            $table->string('short_name', 100)->default('');
            $table->timestamps();
        });
        DatabaseCsvLoader::loadCSVStartupFile('main', cg_csv_seed_path('states'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('states');
    }
}
