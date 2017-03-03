<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Address extends BaseTenantModel {


	protected $fillable = [
		'address1',
		'address2',
		'city',
		'state',
		'zip',
		'country',
		'state_id',
		'county_id',
		'comments',
		'active'
	    ];


}