<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class InventoryCompleteDate extends BaseModel {


	protected $fillable = [
		'user_id',
		'user_id_for_entry_lock',
		'store_id',
		'inventory_start_date',
		'inventory_end_date',
		'comments'
	    ];


}