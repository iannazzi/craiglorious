<?php

$factory->define(App\Models\Tenant\StoreCreditCard::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->name,
		'card_number' => $faker->name,
		'card_type' => $faker->name,
		'date_created' => $faker->name,
		'date_issued' => $faker->name,
		'customer_id' => $faker->name,
		'original_amount' => $faker->name,
		'locked' => $faker->name,
		'comments' => $faker->name
    ];
});