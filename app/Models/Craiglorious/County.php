<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class County extends BaseCraigloriousModel {


	protected $fillable = [
		'state_id',
		'county_name',
		'nick_name',
		'tax_jurisdiction_id'
	    ];


}