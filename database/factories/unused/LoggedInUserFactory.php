<?php

$factory->define(App\Models\Tenant\LoggedInUser::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->name,
		'http_user_agent' => $faker->name,
		'ip_address' => $faker->name,
		'browser' => $faker->name,
		'last_accessed' => $faker->name,
		'current_page' => $faker->name,
		'session_time_remaining' => $faker->name
    ];
});