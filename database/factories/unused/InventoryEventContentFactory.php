<?php

$factory->define(App\Models\Tenant\InventoryEventContent::class, function (Faker\Generator $faker) {
    return [
        'inventory_event_id' => $faker->name,
		'barcode' => $faker->name,
		'product_sub_id' => $faker->name,
		'price_level' => $faker->name,
		'inventory_type' => $faker->name,
		'quantity' => $faker->name,
		'inventory_tracking_number' => $faker->name,
		'value' => $faker->name,
		'storage_cost' => $faker->name,
		'purchasing_cost' => $faker->name,
		'expiration_date' => $faker->name,
		'lot_number' => $faker->name,
		'action' => $faker->name,
		'comments' => $faker->name,
		'unique_tag' => $faker->name
    ];
});