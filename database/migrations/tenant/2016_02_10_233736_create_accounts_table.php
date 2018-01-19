<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('coa_number');
            $table->string('account_number');
            $table->string('routing_number');
            $table->string('type');
            $table->boolean('required')->nullable();
            $table->text('description')->nullable();

            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('linked_id')->unsigned()->index(); //debit cards, cc multiple users
            $table->integer('autopay_id')->unsigned()->index();
            $table->integer('default_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();

            $table->string('check_name');

            $table->string('address1', 40);
            $table->string('address2', 40);
            $table->string('city', 40);
            $table->string('state', 40);
            $table->string('zip', 20);

            $table->string('website_url');
            $table->string('website_username', 40);
            $table->string('website_password');

            $table->json('old_account_numbers')->nullable();
            $table->dateTime('verification_lock_date');

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
        Schema::drop('accounts');
    }
}
