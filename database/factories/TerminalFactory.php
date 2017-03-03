<?php

$factory->define(App\Models\Tenant\Terminal::class, function (Faker\Generator $faker) {
    return [
		'status' => 'open',
        'location' => $faker->streetName,
        'comments' => '',
        'terminal_name' => $faker->firstNameFemale,
        'terminal_description' => '',
        'cookie_name' => '',
        'active' => 1
//		'mac_address' => $faker->name,
//		'ip_address' => $faker->name,
//		'cash_drawer' => $faker->name,
//		'printer_id' => $faker->name,
//		'default_cash_account_id' => $faker->name,
//		'default_check_account_id' => $faker->name,
//		'default_gift_card_account_id' => $faker->name,
//		'default_store_credit_account_id' => $faker->name,
//		'default_prepay_account_id' => $faker->name,
//		'default_non_payment_account_id' => $faker->name,
//		'payment_gateway_id' => $faker->name,
//		'refund_checking_account_id' => $faker->name,
//		'max_cash_refund' => $faker->name,

    ];
});