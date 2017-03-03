<?php

$factory->define(App\Models\Tenant\InventoryCompleteDate::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->name,
		'user_id_for_entry_lock' => $faker->name,
		'store_id' => $faker->name,
		'inventory_start_date' => $faker->name,
		'inventory_end_date' => $faker->name,
		'comments' => $faker->name
    ];
});