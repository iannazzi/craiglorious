<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class SalesTaxCategory extends BaseCraigloriousModel {


	protected $fillable = [
		'tax_category_name',
		'tax_exempt',
		'active'
	    ];


}