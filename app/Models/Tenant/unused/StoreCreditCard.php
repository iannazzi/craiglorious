<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class StoreCreditCard extends BaseModel {


	protected $fillable = [
		'user_id',
		'card_number',
		'card_type',
		'date_created',
		'date_issued',
		'customer_id',
		'original_amount',
		'locked',
		'comments'
	    ];


}