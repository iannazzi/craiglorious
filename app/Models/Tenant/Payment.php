<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Payment extends BaseModel {


	protected $fillable = [
		'source_journal',
		'reference_id',
		'store_id',
		'employee_id',
		'user_id',
		'account_id',
		'payee_account_id',
		'manufacturer_id',
		'payment_date',
		'post_date',
		'payment_entry_date',
		'payment_amount',
		'payment_status',
		'applied_status',
		'validated',
		'post_validated',
		'comments',
		'binary_content',
		'file_name',
		'file_type',
		'file_size'
	    ];


}