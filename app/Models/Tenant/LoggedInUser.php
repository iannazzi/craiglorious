<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class LoggedInUser extends BaseModel {


	protected $fillable = [
		'user_id',
		'http_user_agent',
		'ip_address',
		'browser',
		'last_accessed',
		'current_page',
		'session_time_remaining'
	    ];


}