<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductImage extends BaseModel {


	protected $fillable = [
		'image',
		'image_type',
		'original_image_name',
		'view',
		'crop_coordinates',
		'web_url',
		'path',
		'active',
		'comments',
		'date_added'
	    ];


}