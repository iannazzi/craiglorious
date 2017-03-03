<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductSkuSalePrice extends BaseModel {


	protected $fillable = [
		'product_sku_id',
		'sale_barcode',
		'price_level',
		'price',
		'title',
		'as_is',
		'clearance',
		'comments'
	    ];


}