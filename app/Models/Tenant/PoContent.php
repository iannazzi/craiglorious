<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class PoContent extends BaseModel {


	protected $fillable = [
		'po_id',
		'poc_row_number',
		'size_row',
		'size_column',
		'style_number',
		'style_number_source',
		'color_code',
		'color_description',
		'title',
		'product_category_id',
		'cup',
		'inseam',
		'attributes',
		'size',
		'cost',
		'retail',
		'discount',
		'discount_quantity',
		'product_sku_id',
		'quantity_ordered',
		'adjustment_quantity',
		'quantity_received',
		'quantity_missing',
		'quantity_canceled',
		'quantity_added',
		'quantity_damaged',
		'quantity_returning',
		'returning_comments',
		'received_date_qty',
		'comments',
		'receive_comments'
	    ];


}