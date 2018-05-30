<?php

$factory->define(App\Models\Tenant\Discount::class, function (Faker\Generator $faker) {
    return [
        'discount_name' => $faker->name,
		'discount_code' => $faker->name,
		'discount_amount' => $faker->name,
		'percent_or_dollars' => $faker->name,
		'max_discount' => $faker->name,
		'active' => $faker->name,
		'admin_only' => $faker->name,
		'comments' => $faker->name
    ];
});