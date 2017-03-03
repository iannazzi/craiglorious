<?php

$factory->define(App\Models\Tenant\Brand::class, function (Faker\Generator $faker) {
    return [
        //'manufacturer_id' => $faker->name,
		'name' => $faker->lastName,
		//'sales_rep_email' => $faker->name,
		//'sales_rep_name' => $faker->name,
		//'sales_rep_phone' => $faker->name,
		'active' => 1,
		'comments' => $faker->paragraph(),
    ];
});