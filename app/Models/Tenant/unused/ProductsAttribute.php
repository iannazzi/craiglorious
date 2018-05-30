<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductsAttribute extends BaseModel {


	protected $fillable = [
		'product_id',
		'attribute_name',
		'caption',
		'attribute_code',
		'options',
		'priority'
	    ];


}