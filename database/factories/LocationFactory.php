<?php

$factory->define(App\Models\Tenant\Location::class, function (Faker\Generator $faker) {
    return [
        'parent_location_id' => $faker->name,
		'location_name' => $faker->name,
		'barcode' => $faker->name,
		'store_id' => $faker->name,
		'location_group_id' => $faker->name,
		'priority' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});