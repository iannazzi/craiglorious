<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PoReceiveContent extends BaseModel {


	protected $fillable = [
		'po_receive_event_id',
		'po_content_id',
		'received_quantity',
		'receive_comments'
	    ];


}