<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Promotion extends BaseModel {


	protected $fillable = [
		'promotion_name',
		'promotion_code',
		'promotion_type',
		'start_date',
		'expiration_date',
		'promotion_amount',
		'item_or_total',
		'blanket',
		'percent_or_dollars',
		'buy_x',
		'get_y',
		'expired_value',
		'qualifying_amount',
		'check_if_can_be_applied_to_sale_items',
		'check_if_can_be_applied_to_clearance_items',
		'active',
		'comments'
	    ];


}