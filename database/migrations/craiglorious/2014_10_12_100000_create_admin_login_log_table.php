<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminLoginLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_login_log', function(Blueprint $table)
		{
			$table->increments('admin_login_log_id');
			$table->string('ip', 55);
			$table->string('proxy_ip', 55);
			$table->dateTime('date');
			$table->string('error');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_login_log');
	}

}
