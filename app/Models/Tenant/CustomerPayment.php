<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class CustomerPayment extends BaseModel {


	protected $fillable = [
		'payment_gateway_id',
		'transaction_status',
		'account_id',
		'deposit_account_id',
		'customer_payment_method_id',
		'customer_payment_batch_id',
		'card_number',
		'store_credit_id',
		'date',
		'payment_amount',
		'reference_number',
		'transaction_id',
		'authorization_code',
		'batch_id',
		'payment_status',
		'summary',
		'comments'
	    ];


}