<?php

$factory->define(App\Models\Tenant\PoReceiveEvent::class, function (Faker\Generator $faker) {
    return [
        'po_id' => $faker->name,
		'user_id' => $faker->name,
		'terminal_id' => $faker->name,
		'store_id' => $faker->name,
		'receive_date' => $faker->name,
		'pick_ticket' => $faker->name,
		'comments' => $faker->name,
		'wrong_items_comments' => $faker->name
    ];
});