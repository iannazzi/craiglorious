<?php

$factory->define(App\Models\Tenant\ChartOfAccount::class, function (Faker\Generator $faker) {
    return [
		'number' => $faker->name,
		'name' => $faker->name,
		'type' => $faker->name,
		'sub_type' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});