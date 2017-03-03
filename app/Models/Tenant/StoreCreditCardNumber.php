<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class StoreCreditCardNumber extends BaseModel {


	protected $fillable = [
		'card_number',
		'date_created',
		'date_printed'
	    ];


}