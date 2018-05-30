<?php

$factory->define(App\Models\Tenant\ShippingOption::class, function (Faker\Generator $faker) {
    return [
        'sales_tax_category_id' => $faker->name,
		'barcode' => $faker->name,
		'carrier_name' => $faker->name,
		'method_name' => $faker->name,
		'priority' => $faker->name,
		'weight_min' => $faker->name,
		'weight_max' => $faker->name,
		'fee' => $faker->name,
		'fee_type' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});