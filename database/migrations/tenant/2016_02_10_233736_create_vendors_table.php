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
            $table->string('check_name')->nullable();
            $table->string('account_number')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('main_email')->nullable();
            $table->string('cc_email')->nullable();
            $table->string('main_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();

            $table->string('tax_id')->nullable();
            $table->boolean('1099');
            $table->text('old_account_numbers')->nullable();

            $table->string('website_url')->nullable();
            $table->string('website_username', 40)->nullable();
            $table->string('website_password', 40)->nullable();


            $table->decimal('credit_limit', 20, 5)->nullable();
            $table->string('terms', 64)->default('')->nullable();
            $table->integer('days')->nullable();
            $table->decimal('discount', 10, 5)->nullable();
            $table->boolean('autopay');
            $table->decimal('interest_rate', 10, 5)->nullable();

            $table->dateTime('verification_lock_date')->nullable();
            $table->boolean('active');
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('description')->nullable();
            $table->text('comments')->nullable();
            $table->unique(['name', 'account_number']);
            $table->timestamps();
            $table->softDeletes();


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
