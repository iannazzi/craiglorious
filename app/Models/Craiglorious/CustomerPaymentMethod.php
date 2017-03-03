<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class CustomerPaymentMethod extends BaseCraigloriousModel {


	protected $fillable = [
		'payment_type',
		'payment_group',
		'active'
	    ];


}