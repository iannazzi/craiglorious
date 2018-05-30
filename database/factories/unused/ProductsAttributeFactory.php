<?php

$factory->define(App\Models\Tenant\ProductsAttribute::class, function (Faker\Generator $faker) {
    return [
        'product_id' => $faker->name,
		'attribute_name' => $faker->name,
		'caption' => $faker->name,
		'attribute_code' => $faker->name,
		'options' => $faker->name,
		'priority' => $faker->name
    ];
});