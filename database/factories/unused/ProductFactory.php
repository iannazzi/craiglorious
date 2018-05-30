<?php

$factory->define(App\Models\Tenant\Product::class, function (Faker\Generator $faker) {
    return [
		'code' => $faker->randomNumber(5),
		'title' => $faker->firstNameFemale,
		'description' => $faker->paragraph(),
		'active' => 1
    ];
});