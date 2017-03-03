<?php

$factory->define(App\Models\Tenant\Printer::class, function (Faker\Generator $faker) {
    return [
        'store_id' => $faker->name,
		'account_id' => $faker->name,
		'printer_name' => $faker->name,
		'printer_description' => $faker->name,
		'media' => $faker->name,
		'location' => $faker->name,
		'comments' => $faker->name,
		'active' => $faker->name
    ];
});