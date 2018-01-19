<?php
use App\Models\Craiglorious\View;
use Illuminate\Database\Seeder;
	
class ViewsTableSeeder extends Seeder
{


    public function run()
	{


        $views = [
            [
                'name' => 'Calendar',
                'icon' => 'fa fa-calendar',
                'place' => json_encode(['Office','Customer Counter', 'Back Room']),
                'priority'=> 0,
                'route'=> 'calendar',
            ],
            [
                'name' => 'Accounts',
                'icon' => 'fa fa-list',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'accounts',
            ],
            [
                'name' => 'Vendors',
                'icon' => 'fa fa-industry',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'vendors',
            ],
            [
                'name' => 'Bills & Receipts',
                'icon' => 'fa fa-book',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'bills',
            ],
            [
                'name' => 'Pay Vendor',
                'icon' => 'fa fa-briefcase',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'pay_vendor',
            ],
            [
                'name' => 'Transfer $$',
                'icon' => 'fa fa-long-arrow-right',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'transfer',
            ],
            [
                'name' => 'Employees',
                'icon' => 'fa fa-users',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'employees',
            ],
            [
                'name' => 'Payroll',
                'icon' => 'fa fa-book',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'payroll',
            ],
            [
                'name' => 'Reports',
                'icon' => 'fa fa-pie-chart',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'reports',
            ],
            [
                'name' => 'Accounting Setup',
                'icon' => 'fa fa-cog',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'accounting_setup',
            ],
            [
                'name' => 'Customers',
                'icon' => 'fa fa-handshake-o',
                'place' => json_encode(['Customer Counter']),
                'priority'=> 0,
                'route'=> 'customers',
            ],
            [
                'name' => 'Point Of Sale',
                'icon' => 'fa fa-money',
                'place' => json_encode(['Customer Counter']),
                'priority'=> 0,
                'route'=> 'invoices',
            ],
            [
                'name' => 'Discounts',
                'icon' => 'fa fa-minus-square-o',
                'place' => json_encode(['Customer Counter']),
                'priority'=> 0,
                'route'=> 'discounts',
            ],
            [
                'name' => 'Promotions',
                'icon' => 'fa fa-plus-square-o',
                'place' => json_encode(['Customer Counter']),
                'priority'=> 0,
                'route'=> 'promotions',
            ],
            [
                'name' => 'Store Credit',
                'icon' => 'fa fa-credit-card-alt',
                'place' => json_encode(['Customer Counter']),
                'priority'=> 0,
                'route'=> 'store_credit',
            ],
            [
                'name' => 'Services',
                'icon' => 'fa fa-sign-language',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'services',
            ],
            [
                'name' => 'Brands',
                'icon' => 'fa fa-address-card-o',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'brands',
            ],
            [
                'name' => 'Purchase Orders',
                'icon' => 'fa fa-truck',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'purchase_orders',
            ],
            [
                'name' => 'Consignment',
                'icon' => 'fa fa-percent',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'consignment',
            ],
            [
                'name' => 'Items',
                'icon' => 'fa fa-television',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'items',
            ],
            [
                'name' => 'Assemblies',
                'icon' => 'fa fa-object-group',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'assemblies',
            ],
            [
                'name' => 'Purchase Returns',
                'icon' => 'fa fa-long-arrow-left',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'purchase_returns',
            ],
            [
                'name' => 'Locations',
                'icon' => 'fa fa-cubes',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'locations',
            ],
            [
                'name' => 'Inventory',
                'icon' => 'fa fa-barcode',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'inventory',
            ],
            [
                'name' => 'Transfer Inventory',
                'icon' => 'fa fa-arrows-h',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'transfer_inventory',
            ],
            [
                'name' => 'Shipping Methods',
                'icon' => 'fa fa-plane',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'shipping',
            ],
            [
                'name' => 'Payment Gateways',
                'icon' => 'fa fa-cc-visa',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'payment_gateways',
            ],
            [
                'name' => 'Cash Registers',
                'icon' => 'fa fa-hdd-o',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'registers',
            ],
            [
                'name' => 'Terminals',
                'icon' => 'fa fa-laptop',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'terminals',
            ],
            [
                'name' => 'Printers',
                'icon' => 'fa fa-print',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'printers',
            ],
            [
                'name' => 'Employee Handbook',
                'icon' => 'fa fa-book',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'employee_handbook',
            ],
            [
                'name' => 'Messages',
                'icon' => 'fa fa-comment',
                'place' => json_encode(['Office','Customer Counter']),
                'priority'=> 0,
                'route'=> 'messages',
            ],
            [
                'name' => 'Documents',
                'icon' => 'fa fa-file-text-o',
                'place' => json_encode(['Office']),
                'priority'=> 0,
                'route'=> 'documents',
            ],
            [
                'name' => 'Images',
                'icon' => 'fa fa-picture-o',
                'place' => json_encode(['Back Room']),
                'priority'=> 0,
                'route'=> 'images',
            ],
            [
                'name' => 'Roles',
                'icon' => 'fa fa-lock',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'roles',
            ],
            [
                'name' => 'Users',
                'icon' => 'fa fa-user-circle',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'users',
            ],
            [
                'name' => 'System Settings',
                'icon' => 'fa fa-cogs',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'system',
            ],
            [
                'name' => 'Browser Test',
                'icon' => 'fa fa-safari',
                'place' => json_encode(['System']),
                'priority'=> 0,
                'route'=> 'browser_tests',
            ],

        ];

        \DB::table('views')->insert($views);


    }
}