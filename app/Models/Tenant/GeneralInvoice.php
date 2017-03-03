<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class GeneralInvoice extends BaseModel {


	protected $fillable = [
		'employee_id',
		'user_id',
		'store_id',
		'entry_type',
		'validated',
		'invoice_date',
		'invoice_due_date',
		'invoice_status',
		'payment_status',
		'invoice_number',
		'invoice_type',
		'payment_date',
		'entry_date',
		'entry_amount',
		'use_tax',
		'minimum_amount_due',
		'discount_applied',
		'discount_lost',
		'chart_of_accounts_id',
		'account_id',
		'supplier',
		'description',
		'payments_applied',
		'comments',
		'binary_content',
		'file_name',
		'file_type',
		'file_size'
	    ];


}