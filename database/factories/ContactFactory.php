<?php


$factory->define(App\Models\Tenant\Contact::class, function (Faker\Generator $faker) {
	return  [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'email' => $faker->email,
		'email2' => $faker->email,
		'phone' => $faker->phoneNumber,
		'mobile' => $faker->phoneNumber,
		'fax' => $faker->phoneNumber,

	];
});
