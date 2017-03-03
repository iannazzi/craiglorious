<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class UserHit extends BaseModel {


	protected $fillable = [
		'user_id',
		'time',
		'url',
		'ip_address',
		'browser'
	    ];


}