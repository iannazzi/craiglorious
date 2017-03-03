<?php

$factory->define(App\Models\Tenant\User::class, function (Faker\Generator $faker) {
    return [
        'user_group_id' => $faker->name,
		'employee_id' => $faker->name,
		'first_name' => $faker->name,
		'last_name' => $faker->name,
		'active' => $faker->name,
		'username' => $faker->name,
		'password' => $faker->name,
		'email' => $faker->name
    ];
});