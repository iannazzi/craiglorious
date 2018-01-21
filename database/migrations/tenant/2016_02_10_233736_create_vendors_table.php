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



            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('city');
            $table->string('zip');
            $table->integer('state_id')->unsigned()->index()->nullable();


            $table->text('old_account_numbers');

            $table->string('website_url');
            $table->string('website_username', 40);
            $table->string('website_password', 40);


            $table->boolean('autopay');

            $table->dateTime('verification_lock_date')->nullable();
            $table->boolean('active');
            $table->text('description');
            $table->text('comments');
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
