<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\AccountType;

class Account extends BaseTenantModel {
//use account to track what you buy

	protected $fillable = [
		'linked_account_id',
		'account_type_id',
		'store_id',
		'address_id',
		'parent_chart_of_accounts_id',
		'default_payment_chart_of_accounts_id',
		'legal_name',
		'website_url',
		'username',
		'password',
		'account_number',
		'company',
		'primary_contact',
		'email',
		'credit_limit',
		'terms',
		'days',
		'discount',
		'autopay',
		'autopay_account_id',
		'interest_rate',
		'balance_init',
		'verification_lock_date',
		'priority',
		'active',
		'comments'
	    ];
	public function accountNotes()
	{
		/*
		 * Account notes
		 *
		 * I want to hide as many accounts as possible
		 * They should show up as needed
		 *
		 * For example sales tax: We need to pay new york state, other states show up as needed
		 *
		 *
		 *Fixed Assets: Financial start date for fixed assets
		 *ASset: asset numner (fa-0001)
		 * purchase date
		 * purchase price
		 * description
		 */
	}
	public function automaticAccount()
	{
		//create these accounts automatically
		//accounts receivable
		//accounts payable
		//undeposited funds
		//inventory asset
	}
	public function getAccountTypes()
	{
		return [

			[
				'type' => 'Cash',
				'description' => 'Cash Registers, Petty Cash, Cash Accounts, Deposit Bags, Safe. This may have a physical location'
			],

			[
				'type' => 'Bank',
				'description' => 'This can have a routing number, also can write checks. Also will link debit cards.'
			],
			[
				'type' => 'Debit Card',
				'description' => 'Debit Cards Pull straight from checking account, so it actually is similar to using a check, not like a credit card at all.'
			],
			[
				'type' => 'Accounts Receivable',
				'description' => 'Should not use, use customers, vendors (credit memos) and payment_gateways instead?'
			],
			[
				'type' => 'Current Asset',
				'description' => ''
			],
			[
				'type' => 'Long-Term Asset',
				'description' => ''
			],
			[
				'type' => 'Other Asset',
				'description' => ''
			],
			[
				'type' => 'Accounts Payable',
				'description' => 'Short Term (i.e. 30 days) money owed, specifically credit you have with vendors. If the account is linked to a MFG then I know it is for inventory'
			],
			[
				'type' => 'Credit Card',
				'description' => 'Credit Cards'
			],
			[
				'type' => 'Other Current Liability',
				'description' => 'Customer Deposits, Sales Tax, Payroll Tax'
			],
			[
				'type' => 'Short Term Liability',
				'description' => 'Line Of Credit, Over Draft, Short Term Loans.'
			],
			[
				'type' => 'Long Term Liability',
				'description' => 'Liabilities such as loans or mortgages scheduled to be paid over periods longer than one year.'
			],
			[
				'type' => 'Equity',
				'description' => 'Owner\'s equity, including capital investment, drawings, and retained earnings.'
			],
			[
				'type' => 'Revenue',
				'description' => 'Income'
			],
			[
				'type' => 'Cost Of Goods Sold',
				'description' => 'Cost Of Goods Sold for services, products, purchase discounts, etc'
			],
			[
				'type' => 'Expense',
				'description' => ''
			]

		];
	}


}