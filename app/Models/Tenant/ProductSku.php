<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class ProductSku extends BaseTenantModel {


	protected $fillable = [
		'product_id',
		'product_color_id',
		'active',
		'inventory_warning',
		'product_sku',
		'product_upc',
		'product_subid_name',
		'barcode',
		'attributes_hash',
		'attributes_list',
		'comments'
	    ];

	public static function createFromArray($option)
	{
		foreach($option as $key => $value)
		{

		}
	}
	public function product()
	{
		$this->belongsTo(Product::class);
	}
	public function options()
	{
		return $this->belongsToMany(ProductOption::class)->withTimestamps();
		//return $this->belongsToMany(ProductOption::class, 'product_options_product_skus');
	}

	public function getAttributeId($key)
	{
		//option can be a name or an integer
		if(is_int($key))
		{
			return $key;
		}
		$key = ProductAttribute::where('name', '=', $key);
	}


}