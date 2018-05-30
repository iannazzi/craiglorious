<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PromotionBuy extends BaseModel {


	protected $fillable = [
		'promotion_id',
		'buy',
		'get',
		'discount',
		'd_or_p'
	    ];


}