<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class InventoryLog extends BaseModel {


	protected $fillable = [
		'chart_of_accounts_id',
		'product_sub_id',
		'user_id',
		'store_id',
		'inventory_type',
		'quantity',
		'location_id',
		'inventory_tracking_number',
		'value',
		'inventory_date',
		'storage_cost',
		'purchasing_cost',
		'expiration_date',
		'lot_number',
		'action',
		'comments',
		'unique_tag'
	    ];


}