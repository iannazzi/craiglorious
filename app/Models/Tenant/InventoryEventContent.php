<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class InventoryEventContent extends BaseModel {


	protected $fillable = [
		'inventory_event_id',
		'barcode',
		'product_sub_id',
		'price_level',
		'inventory_type',
		'quantity',
		'inventory_tracking_number',
		'value',
		'storage_cost',
		'purchasing_cost',
		'expiration_date',
		'lot_number',
		'action',
		'comments',
		'unique_tag'
	    ];


}