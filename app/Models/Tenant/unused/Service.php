<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Service extends BaseModel {


	protected $fillable = [
		'sales_tax_category_id',
		'barcode',
		'service_name',
		'description',
		'active',
		'unit_of_measure',
		'retail_price',
		'cost',
		'comments'
	    ];


}