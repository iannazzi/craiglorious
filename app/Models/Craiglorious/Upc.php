<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class Upc extends BaseCraigloriousModel {


	protected $fillable = [
		'manufacturer_id',
		'upc_code',
		'date_added',
		'style_number',
		'style_description',
		'color_code',
		'color_description',
		'size',
		'msrp',
		'cost',
		'comments'
	    ];


}