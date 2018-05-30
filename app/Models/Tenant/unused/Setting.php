<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Setting extends BaseModel {


	protected $fillable = [
		'visible',
		'input_type',
		'group_name',
		'priority',
		'name',
		'value',
		'value_text',
		'options',
		'default_value',
		'validation',
		'caption',
		'description'
	    ];


}