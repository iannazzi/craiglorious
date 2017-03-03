<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Customer extends BaseModel {


	protected $fillable = [
		'user_id',
		'date_added',
		'first_name',
		'last_name',
		'default_address_id',
		'email1',
		'phone',
		'company',
		'address1',
		'address2',
		'city',
		'state_id',
		'state',
		'zip',
		'country',
		'country_id',
		'comments',
		'status',
		'active'
	    ];


}