<?php

$factory->define(App\Models\Tenant\InventoryEvent::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->name,
		'user_id_for_entry_lock' => $faker->name,
		'store_id' => $faker->name,
		'location_id' => $faker->name,
		'inventory_date' => $faker->name,
		'comments' => $faker->name
    ];
});