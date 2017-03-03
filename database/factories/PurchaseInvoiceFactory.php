<?php

$factory->define(App\Models\Tenant\PurchaseInvoice::class, function (Faker\Generator $faker) {
    return [
        'manufacturer_id' => $faker->name,
		'invoice_number' => $faker->name,
		'invoice_status' => $faker->name,
		'invoice_type' => $faker->name,
		'invoice_date' => $faker->name,
		'invoice_due_date' => $faker->name,
		'credit_memo_used_date' => $faker->name,
		'invoice_received_date' => $faker->name,
		'invoice_amount' => $faker->name,
		'show_discount' => $faker->name,
		'discount_applied' => $faker->name,
		'discount_available' => $faker->name,
		'discount_lost' => $faker->name,
		'discount_coa_account_id' => $faker->name,
		'shipping_amount' => $faker->name,
		'fee_amount' => $faker->name,
		'invoice_entry_date' => $faker->name,
		'validated' => $faker->name,
		'payment_status' => $faker->name,
		'payments_applied' => $faker->name,
		'user_id' => $faker->name,
		'account_id' => $faker->name,
		'asset_coa_account_id' => $faker->name,
		'binary_content' => $faker->name,
		'file_name' => $faker->name,
		'file_type' => $faker->name,
		'file_size' => $faker->name,
		'comments' => $faker->name
    ];
});