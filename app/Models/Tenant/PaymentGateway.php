<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PaymentGateway extends BaseModel {


	protected $fillable = [
		'id',
		'store_id',
		'account_id',
		'login_id',
		'transaction_key',
		'gateway_provider',
		'model_name',
		'website_url',
		'user_name',
		'password',
		'line',
		'active',
		'comments'
	    ];


}