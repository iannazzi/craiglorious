<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminUserLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_user_log', function(Blueprint $table)
		{
			$table->increments('admin_user_log_id');
			$table->integer('admin_user_id')->unsigned()->index('user_id');
			$table->dateTime('time');
			$table->text('url', 65535);
			$table->string('ip_address', 20);
			$table->string('browser', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_user_log');
	}

}
