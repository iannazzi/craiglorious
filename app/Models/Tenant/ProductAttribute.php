<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductAttribute extends BaseModel {


	protected $fillable = [
		'name',
		'priority',
		'active',
		'locked',
		'comments'
	    ];
	function productOptions()
	{
		//Select * from product_options where product_attribute_id = $this->id
		$this->hasMany(ProductOption::class);
	}

}