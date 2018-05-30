<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\ChartOfAccountsRequired;
use App\Models\Craiglorious\ChartOfAccountType;

class ChartOfAccount extends BaseTenantModel {


	protected $fillable = [
		'number',
		'name',
		'type',
		'sub_type',
		'active',
		'comments'
	    ];


}