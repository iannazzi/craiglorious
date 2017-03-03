<?php

$factory->define(App\Models\Tenant\Service::class, function (Faker\Generator $faker) {
    return [
        'sales_tax_category_id' => $faker->name,
		'barcode' => $faker->name,
		'service_name' => $faker->name,
		'description' => $faker->name,
		'active' => $faker->name,
		'unit_of_measure' => $faker->name,
		'retail_price' => $faker->name,
		'cost' => $faker->name,
		'comments' => $faker->name
    ];
});