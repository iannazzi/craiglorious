<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class JournalToCoaLink extends BaseModel {


	protected $fillable = [
		'Journal',
		'link_name',
		'comments',
		'chart_of_accounts_id'
	    ];


}