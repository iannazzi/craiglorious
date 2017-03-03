<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PoReceiveEvent extends BaseModel {


	protected $fillable = [
		'po_id',
		'user_id',
		'terminal_id',
		'store_id',
		'receive_date',
		'pick_ticket',
		'comments',
		'wrong_items_comments'
	    ];


}