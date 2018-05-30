<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Message extends BaseModel {


	protected $fillable = [
		'to_user_id',
		'from_user_id',
		'message',
		'action_url',
		'response',
		'message_creation_date',
		'message_complete_date'
	    ];


}