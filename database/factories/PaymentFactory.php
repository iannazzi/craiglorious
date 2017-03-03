<?php

$factory->define(App\Models\Tenant\Payment::class, function (Faker\Generator $faker) {
    return [
        'source_journal' => $faker->name,
		'reference_id' => $faker->name,
		'store_id' => $faker->name,
		'employee_id' => $faker->name,
		'user_id' => $faker->name,
		'account_id' => $faker->name,
		'payee_account_id' => $faker->name,
		'manufacturer_id' => $faker->name,
		'payment_date' => $faker->name,
		'post_date' => $faker->name,
		'payment_entry_date' => $faker->name,
		'payment_amount' => $faker->name,
		'payment_status' => $faker->name,
		'applied_status' => $faker->name,
		'validated' => $faker->name,
		'post_validated' => $faker->name,
		'comments' => $faker->name,
		'binary_content' => $faker->name,
		'file_name' => $faker->name,
		'file_type' => $faker->name,
		'file_size' => $faker->name
    ];
});