<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class Currency extends BaseCraigloriousModel {


	protected $fillable = [
		'is_default',
		'title',
		'code',
		'symbol_left',
		'symbol_right',
		'decimal_places',
		'exchange_rate'
	    ];


}