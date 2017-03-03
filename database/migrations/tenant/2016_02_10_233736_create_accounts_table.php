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
            $table->integer('parent_account_id')->unsigned()->index();
            $table->integer('linked_account_id')->unsigned()->index(); //debit cards, cc multiple users
            $table->integer('autopay_account_id')->unsigned()->index();
            $table->integer('default_account_id')->unsigned()->index();
            $table->integer('store_id')->unsigned()->index();
            $table->integer('contact_id')->unsigned()->index();
            $table->integer('department_id')->unsigned()->index();

            $table->integer('address_id')->unsigned()->index();


            $table->string('type');
            $table->boolean('required');
            $table->string('name');
            $table->string('check_name');
            $table->string('coa_number');
            $table->string('account_number');
            $table->string('routing_number');
            $table->text('old_account_numbers')->nullable();

            $table->decimal('credit_limit', 20, 5);
            $table->boolean('autopay');

            $table->decimal('interest_rate', 10, 5);
            $table->dateTime('verification_lock_date');
            $table->boolean('active');

            $table->string('website_url');
            $table->string('website_username', 40);
            $table->string('website_password', 40);

            $table->text('description')->nullable();
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
