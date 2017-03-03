<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo 'Creating Views...';
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('icon', 40);
            $table->json('place');
            $table->string('route');
            $table->boolean('active');
            $table->integer('priority');
            $table->text('comments')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => "ViewsTableSeeder",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('views');
    }
}
