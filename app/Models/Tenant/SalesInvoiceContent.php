<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class SalesInvoiceContent extends BaseModel {


	protected $fillable = [
		'sales_invoice_id',
		'row_number',
		'return_content_id',
		'content_type',
		'store_credit_id',
		'product_sub_id',
		'barcode',
		'checkout_description',
		'color_name',
		'title',
		'size',
		'brand_name',
		'style_number',
		'color_code',
		'retail_price',
		'sale_price',
		'sales_tax_category_id',
		'local_tax_jurisdiction_id',
		'local_regular_sales_tax_rate_id',
		'local_exemption_sales_tax_rate_id',
		'local_regular_tax_rate',
		'local_exemption_tax_rate',
		'local_exemption_value',
		'state_tax_jurisdiction_id',
		'state_regular_sales_tax_rate_id',
		'state_exemption_sales_tax_rate_id',
		'state_regular_tax_rate',
		'state_exemption_tax_rate',
		'state_exemption_value',
		'tax_rate',
		'tax_total',
		'discount',
		'discount_id',
		'discount_type',
		'applied_instore_discount',
		'quantity',
		'extension',
		'special_order_id',
		'alteration_id',
		'special_order',
		'paid',
		'ship',
		'promotion_id',
		'wish_list',
		'comments'
	    ];


}