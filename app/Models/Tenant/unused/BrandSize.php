<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class BrandSize extends BaseModel {


	protected $fillable = [
		'brand_id',
		'category_id',
		'product_attribute_id',
		'case_qty',
		'cup',
		'cup_required',
		'inseam',
		'width',
		'size_modifier',
		'sizes',
		'active',
		'comments'
	    ];


}