<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Manufacturer extends BaseTenantModel {


	protected $fillable = [
		'account_id',
		'company',
		'sales_rep',
		'manufacturer_code',
		'address1',
		'address2',
		'city',
		'state',
		'province',
		'zip',
		'country',
		'email',
		'phone',
		'fax',
		'terms',
		'active',
		'comments'
	    ];


}