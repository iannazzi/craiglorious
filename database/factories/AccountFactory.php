<?php

use App\Models\Tenant\Address;

$factory->defineAs(App\Models\Tenant\Account::class, 'bank', function (Faker\Generator $faker) {
	$bank_names = array('PFCU', 'ESL', 'Bank of America', 'CNB');
	return [
		'store_id' => 1,
		'address_id' => factory(Address::class)->create()->id,
		'type' => 'Bank',
		'name' => $faker->company,
		'account_number' => $faker->creditCardNumber,
		'routing_number' => $faker->creditCardNumber,
		'coa_number' => 11000 +  random_int(1,500),
		'required' => 0,
		'active' => 1
    ];
});

$factory->defineAs(App\Models\Tenant\Account::class, 'cash', function (Faker\Generator $faker) {
	return [
		'store_id' => 1,
		'address_id' => 0,
		'type' => 'Cash',
		'name' => 'Office Cash Box',
		'coa_number' => 10000 +  random_int(1,500),
		'required' => 0,
		'active' => 1
	];
});

$factory->defineAs(App\Models\Tenant\Account::class, 'credit cards', function ($faker) {
	$cc_names = array('Chase Visa', 'Citi', 'Bank of America', 'Capitol One');
	$act = array_rand($cc_names);
	return [
		'address_id' => factory(Address::class)->create()->id,
		'type' => 'Credit Card',
		'name' => $act,
		'check_name' => $act,
		'coa_number' => 20000 +  random_int(1,500),
		'account_number' => $faker->creditCardNumber,
		'old_account_numbers' => $faker->creditCardNumber . PHP_EOL .$faker->creditCardNumber ,
		'required' => 0,
		'active' => 1
	];
});