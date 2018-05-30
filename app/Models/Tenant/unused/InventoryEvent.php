<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class InventoryEvent extends BaseModel {


	protected $fillable = [
		'user_id',
		'user_id_for_entry_lock',
		'store_id',
		'location_id',
		'inventory_date',
		'comments'
	    ];


}