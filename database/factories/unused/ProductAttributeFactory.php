<?php

$factory->define(App\Models\Tenant\ProductAttribute::class, function (Faker\Generator $faker) {
    return [
        'attribute_name' => $faker->name,
		'priority' => $faker->name,
		'active' => $faker->name,
		'locked' => $faker->name,
		'comments' => $faker->name
    ];
});