<?php

$factory->define(App\Models\Tenant\Message::class, function (Faker\Generator $faker) {
    return [
        'to_user_id' => $faker->name,
		'from_user_id' => $faker->name,
		'message' => $faker->name,
		'action_url' => $faker->name,
		'response' => $faker->name,
		'message_creation_date' => $faker->name,
		'message_complete_date' => $faker->name
    ];
});