<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ShippingOption extends BaseModel {


	protected $fillable = [
		'sales_tax_category_id',
		'barcode',
		'carrier_name',
		'method_name',
		'priority',
		'weight_min',
		'weight_max',
		'fee',
		'fee_type',
		'active',
		'comments'
	    ];


}