<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductCategory extends BaseModel {


	protected $fillable = [
		'parent',
		'level',
		'priority',
		'default_product_priority',
		'sales_tax_category_id',
		'is_visible',
		'list_subcats',
		'url_hash',
		'url_default',
		'url_custom',
		'key_name',
		'category_header',
		'meta_keywords',
		'meta_title',
		'meta_description',
		'name',
		'description',
		'description_bottom',
		'category_path',
		'active'
	    ];


}