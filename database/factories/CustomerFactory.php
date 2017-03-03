<?php

$factory->define(App\Models\Tenant\Customer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->name,
		'date_added' => $faker->name,
		'first_name' => $faker->name,
		'last_name' => $faker->name,
		'default_address_id' => $faker->name,
		'email1' => $faker->name,
		'phone' => $faker->name,
		'company' => $faker->name,
		'address1' => $faker->name,
		'address2' => $faker->name,
		'city' => $faker->name,
		'state_id' => $faker->name,
		'state' => $faker->name,
		'zip' => $faker->name,
		'country' => $faker->name,
		'country_id' => $faker->name,
		'comments' => $faker->name,
		'status' => $faker->name,
		'active' => $faker->name
    ];
});