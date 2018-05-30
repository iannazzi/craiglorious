<?php

$factory->define(App\Models\Tenant\SalesInvoice::class, function (Faker\Generator $faker) {
    return [
        'return_invoice_id' => $faker->name,
		'store_id' => $faker->name,
		'terminal_id' => $faker->name,
		'chart_of_account_id' => $faker->name,
		'user_id' => $faker->name,
		'sales_associate_id' => $faker->name,
		'employee_id' => $faker->name,
		'user_id_for_entry_lock' => $faker->name,
		'customer_id' => $faker->name,
		'address_id' => $faker->name,
		'invoice_number' => $faker->name,
		'invoice_date' => $faker->name,
		'shipping_amount' => $faker->name,
		'tax_calculation_method' => $faker->name,
		'invoice_status' => $faker->name,
		'payment_status' => $faker->name,
		'follow_up' => $faker->name,
		'special_order' => $faker->name,
		'comments' => $faker->name
    ];
});