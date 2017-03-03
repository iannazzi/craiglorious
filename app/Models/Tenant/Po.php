<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Po extends BaseModel {


	protected $fillable = [
		'user_id_for_entry_lock',
		'manufacturer_id',
		'brand_id',
		'category_id',
		'user_id',
		'store_id',
		'po_number',
		'manufacturer_po_number',
		'po_type',
		'create_date',
		'placed_date',
		'status_date',
		'delivery_date',
		'cancel_date',
		'received_date',
		'receive_store_id',
		'receive_user_id',
		'employee_po_creater_name',
		'po_status',
		'ordered_status',
		'received_status',
		'invoice_status',
		'comments',
		'po_title',
		'stored_size_chart',
		'wrong_items_qty',
		'wrong_items_comments',
		'log',
		'ra_required',
		'ra_number',
		'credit_memo_required',
		'credit_memo_invoice_number'
	    ];


}