<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PurchaseInvoice extends BaseModel {


	protected $fillable = [
		'manufacturer_id',
		'invoice_number',
		'invoice_status',
		'invoice_type',
		'invoice_date',
		'invoice_due_date',
		'credit_memo_used_date',
		'invoice_received_date',
		'invoice_amount',
		'show_discount',
		'discount_applied',
		'discount_available',
		'discount_lost',
		'discount_coa_account_id',
		'shipping_amount',
		'fee_amount',
		'invoice_entry_date',
		'validated',
		'payment_status',
		'payments_applied',
		'user_id',
		'account_id',
		'asset_coa_account_id',
		'binary_content',
		'file_name',
		'file_type',
		'file_size',
		'comments'
	    ];


}