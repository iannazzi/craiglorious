<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PromotionLookup extends BaseModel {


	protected $fillable = [
		'promotion_id',
		'product_id',
		'product_category_id',
		'include_subcategories',
		'brand_id',
		'include_product',
		'include_brand',
		'include_category'
	    ];


}