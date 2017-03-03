<?php

$factory->define(App\Models\Tenant\CustomerPayment::class, function (Faker\Generator $faker) {
    return [
        'payment_gateway_id' => $faker->name,
		'transaction_status' => $faker->name,
		'account_id' => $faker->name,
		'deposit_account_id' => $faker->name,
		'customer_payment_method_id' => $faker->name,
		'customer_payment_batch_id' => $faker->name,
		'card_number' => $faker->name,
		'store_credit_id' => $faker->name,
		'date' => $faker->name,
		'payment_amount' => $faker->name,
		'reference_number' => $faker->name,
		'transaction_id' => $faker->name,
		'authorization_code' => $faker->name,
		'batch_id' => $faker->name,
		'payment_status' => $faker->name,
		'summary' => $faker->name,
		'comments' => $faker->name
    ];
});