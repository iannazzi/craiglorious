<?php

$factory->define(App\Models\Tenant\Manufacturer::class, function (Faker\Generator $faker) {
    return [
        'account_id' => $faker->name,
		'address_id' => 0,
		'company' => $faker->company,
		'sales_rep' => $faker->name,
		'email' => $faker->companyEmail,
		'active' => 1,
		//'comments' =>
    ];
});