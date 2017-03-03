<?php

$factory->define(App\Models\Tenant\InventoryLog::class, function (Faker\Generator $faker) {
    return [
        'chart_of_accounts_id' => $faker->name,
		'product_sub_id' => $faker->name,
		'user_id' => $faker->name,
		'store_id' => $faker->name,
		'inventory_type' => $faker->name,
		'quantity' => $faker->name,
		'location_id' => $faker->name,
		'inventory_tracking_number' => $faker->name,
		'value' => $faker->name,
		'inventory_date' => $faker->name,
		'storage_cost' => $faker->name,
		'purchasing_cost' => $faker->name,
		'expiration_date' => $faker->name,
		'lot_number' => $faker->name,
		'action' => $faker->name,
		'comments' => $faker->name,
		'unique_tag' => $faker->name
    ];
});