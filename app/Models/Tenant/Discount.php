<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Discount extends BaseModel {


	protected $fillable = [
		'discount_name',
		'discount_code',
		'discount_amount',
		'percent_or_dollars',
		'max_discount',
		'active',
		'admin_only',
		'comments'
	    ];


}