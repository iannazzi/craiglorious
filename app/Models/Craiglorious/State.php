<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class State extends BaseCraigloriousModel {


	protected $fillable = [
		'default_state_tax',
		'name',
		'short_name'
	    ];


}