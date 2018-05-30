<?php

$factory->define(App\Models\Tenant\LocationGroup::class, function (Faker\Generator $faker) {
    return [
        'location_group_name' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});