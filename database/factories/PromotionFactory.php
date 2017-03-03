<?php

$factory->define(App\Models\Tenant\Promotion::class, function (Faker\Generator $faker) {
    return [
        'promotion_name' => $faker->name,
		'promotion_code' => $faker->name,
		'promotion_type' => $faker->name,
		'start_date' => $faker->name,
		'expiration_date' => $faker->name,
		'promotion_amount' => $faker->name,
		'item_or_total' => $faker->name,
		'blanket' => $faker->name,
		'percent_or_dollars' => $faker->name,
		'buy_x' => $faker->name,
		'get_y' => $faker->name,
		'expired_value' => $faker->name,
		'qualifying_amount' => $faker->name,
		'check_if_can_be_applied_to_sale_items' => $faker->name,
		'check_if_can_be_applied_to_clearance_items' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});