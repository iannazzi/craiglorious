<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class RequiredChartOfAccount extends BaseModel {


	protected $fillable = [
		'chart_of_account_type_id',
		'required_account_name',
		'required_account_code',
		'priority',
		'comments'
	    ];


}