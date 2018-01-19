<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\AccountType;

class Account extends BaseTenantModel {
//use account to track what you buy


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
	public static function getAccountTypes()
	{
		return [

			[
				'name' => 'Cash',
                'value' => 'Cash',
				'description' => 'Cash Registers, Petty Cash, Cash Accounts, Deposit Bags, Safe. This may have a physical location'
			],

			[
				'name' => 'Bank',
                'value' => 'Bank',
				'description' => 'This can have a routing number, also can write checks. Also will link debit cards.'
			],
			[
				'name' => 'Debit Card',
                'value' => 'Debit Card',
                'description' => 'Debit Cards Pull straight from checking account, so it actually is similar to using a check, not like a credit card at all.'
			],
			[
				'name' => 'Accounts Receivable',
                'value' => 'Accounts Receivable',
                'description' => 'Should not use, use customers, vendors (credit memos) and payment_gateways instead?'
			],
			[
				'name' => 'Current Asset',
                'value' => 'Current Asset',
                'description' => ''
			],
			[
				'name' => 'Long-Term Asset',
                'value' => 'Long-Term Asset',
                'description' => ''
			],
			[
				'name' => 'Other Asset',
                'value' => 'Other Asset',
                'description' => ''
			],
			[
				'name' => 'Accounts Payable',
                'value' => 'Accounts Payable',
                'description' => 'Short Term (i.e. 30 days) money owed, specifically credit you have with vendors. If the account is linked to a MFG then I know it is for inventory'
			],
			[
				'name' => 'Credit Card',
                'value' => 'Credit Card',
                'description' => 'Credit Cards'
			],
			[
				'name' => 'Other Current Liability',
                'value' => 'Other Current Liability',
                'description' => 'Customer Deposits, Sales Tax, Payroll Tax'
			],
			[
				'name' => 'Short Term Liability',
                'value' => 'Short Term Liability',
                'description' => 'Line Of Credit, Over Draft, Short Term Loans.'
			],
			[
				'name' => 'Long Term Liability',
                'value' => 'Long Term Liability',
                'description' => 'Liabilities such as loans or mortgages scheduled to be paid over periods longer than one year.'
			],
			[
				'name' => 'Equity',
                'value' => 'Equity',
                'description' => 'Owner\'s equity, including capital investment, drawings, and retained earnings.'
			],
			[
				'name' => 'Revenue',
                'value' => 'Revenue',
                'description' => 'Income'
			],
			[
				'name' => 'Cost Of Goods Sold',
                'value' => 'Cost Of Goods Sold',
                'description' => 'Cost Of Goods Sold for services, products, purchase discounts, etc'
			],
			[
				'name' => 'Expense',
                'value' => 'Expense',
                'description' => ''
			]

		];
	}


}