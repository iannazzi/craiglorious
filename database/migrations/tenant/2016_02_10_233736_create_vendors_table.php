<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lock_id');
            $table->integer('locked_at');

            $table->integer('account_id')->unsigned()->index();
            $table->integer('autopay_account_id')->unsigned()->index();
            $table->integer('currency_id')->unsigned()->index();
            $table->integer('vendor_type_id')->unsigned()->index();
            $table->integer('term_id')->unsigned()->index()->nullable();

            $table->string('type');
            $table->string('name');
            $table->string('check_name');
            $table->string('account_number');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('main_email');
            $table->string('cc_email');
            $table->string('main_phone');
            $table->string('work_phone');
            $table->string('mobile');
            $table->string('fax');

            $table->string('tax_id');
            $table->boolean('1099');
            $table->text('old_account_numbers')->nullable();

            $table->string('website_url');
            $table->string('website_username', 40);
            $table->string('website_password', 40);


            $table->decimal('credit_limit', 20, 5);
            $table->string('terms', 64)->default('');
            $table->integer('days')->nullable();
            $table->decimal('discount', 10, 5)->nullable();
            $table->boolean('autopay');
            $table->decimal('interest_rate', 10, 5);

            $table->dateTime('verification_lock_date');
            $table->boolean('active');
            $table->text('billing_address');
            $table->text('shipping_address');
            $table->text('description');
            $table->text('comments');
            $table->unique(['name', 'account_number']);
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
        Schema::drop('vendors');
    }
}
