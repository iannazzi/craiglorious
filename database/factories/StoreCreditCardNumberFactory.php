<?php

$factory->define(App\Models\Tenant\StoreCreditCardNumber::class, function (Faker\Generator $faker) {
    return [
        'card_number' => $faker->name,
		'date_created' => $faker->name,
		'date_printed' => $faker->name
    ];
});