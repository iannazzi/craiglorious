<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class TaxJurisdiction extends BaseCraigloriousModel {


	protected $fillable = [
		'state_id',
		'jurisdiction_name',
		'jurisdiction_code',
		'default_tax_rate',
		'local_or_state',
		'active'
	    ];


}