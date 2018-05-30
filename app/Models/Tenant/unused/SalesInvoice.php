<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class SalesInvoice extends BaseModel {


	protected $fillable = [
		'return_invoice_id',
		'store_id',
		'terminal_id',
		'chart_of_account_id',
		'user_id',
		'sales_associate_id',
		'employee_id',
		'user_id_for_entry_lock',
		'customer_id',
		'address_id',
		'invoice_number',
		'invoice_date',
		'shipping_amount',
		'tax_calculation_method',
		'invoice_status',
		'payment_status',
		'follow_up',
		'special_order',
		'comments'
	    ];


}