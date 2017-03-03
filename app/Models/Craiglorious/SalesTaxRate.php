<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class SalesTaxRate extends BaseCraigloriousModel {


	protected $fillable = [
		'sales_tax_category_id',
		'start_date',
		'end_date',
		'tax_jurisdiction_id',
		'sales_tax_name',
		'tax_rate',
		'tax_type',
		'exemption_value'
	    ];


}