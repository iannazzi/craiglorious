<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\AccountType;

class Vendor extends BaseTenantModel {


//	protected $fillable = [
//		'contact_id',
//		'billing_address_id',
//		'shipping_address_id',
//		'type',
//		'name',
//		'account_number' ,
//		'active'
//
//	    ];
    protected $guarded = ['id'];
//    protected $casts = [
//        'active' => 'boolean',
//    ];
	public function vendorNotes()
	{
		/*
		 * Vendors link to accounts payable
		 * Vendors also have an expense link
		 * this comes into play when entering a charge?
		 *
		 */
	}
	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
	public function brands()
	{
		return $this->hasMany(Brand::class);
	}
	public function getVendorTypes()
	{
		return [

			[
				'type' => 'Inventory',
				'description' => 'A company you pay for products you order. For example Levi\'s, A wholesaler, a show room'
			],
			[
				'type' => 'Expense',
				'description' => 'A company you pay for products/services you don\'t sell. For Example: U-Line, Rent, Utilities, Hardware store'
			],
			[
				'type' => 'Non-Posting',
				'description' => 'Non posting account to store non payable account information. For example internet accounts like amtrak, shutterfly, ebay, apple, amazon, etc.'
			],

		];
	}


}