<?php

$factory->define(App\Models\Tenant\GeneralInvoice::class, function (Faker\Generator $faker) {
    return [
        'employee_id' => $faker->name,
		'user_id' => $faker->name,
		'store_id' => $faker->name,
		'entry_type' => $faker->name,
		'validated' => $faker->name,
		'invoice_date' => $faker->name,
		'invoice_due_date' => $faker->name,
		'invoice_status' => $faker->name,
		'payment_status' => $faker->name,
		'invoice_number' => $faker->name,
		'invoice_type' => $faker->name,
		'payment_date' => $faker->name,
		'entry_date' => $faker->name,
		'entry_amount' => $faker->name,
		'use_tax' => $faker->name,
		'minimum_amount_due' => $faker->name,
		'discount_applied' => $faker->name,
		'discount_lost' => $faker->name,
		'chart_of_accounts_id' => $faker->name,
		'account_id' => $faker->name,
		'supplier' => $faker->name,
		'description' => $faker->name,
		'payments_applied' => $faker->name,
		'comments' => $faker->name,
		'binary_content' => $faker->name,
		'file_name' => $faker->name,
		'file_type' => $faker->name,
		'file_size' => $faker->name
    ];
});