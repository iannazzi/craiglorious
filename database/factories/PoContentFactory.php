<?php

$factory->define(App\Models\Tenant\PoContent::class, function (Faker\Generator $faker) {
    return [
        'po_id' => $faker->name,
		'poc_row_number' => $faker->name,
		'size_row' => $faker->name,
		'size_column' => $faker->name,
		'style_number' => $faker->name,
		'style_number_source' => $faker->name,
		'color_code' => $faker->name,
		'color_description' => $faker->name,
		'title' => $faker->name,
		'product_category_id' => $faker->name,
		'cup' => $faker->name,
		'inseam' => $faker->name,
		'attributes' => $faker->name,
		'size' => $faker->name,
		'cost' => $faker->name,
		'retail' => $faker->name,
		'discount' => $faker->name,
		'discount_quantity' => $faker->name,
		'product_sku_id' => $faker->name,
		'quantity_ordered' => $faker->name,
		'adjustment_quantity' => $faker->name,
		'quantity_received' => $faker->name,
		'quantity_missing' => $faker->name,
		'quantity_canceled' => $faker->name,
		'quantity_added' => $faker->name,
		'quantity_damaged' => $faker->name,
		'quantity_returning' => $faker->name,
		'returning_comments' => $faker->name,
		'received_date_qty' => $faker->name,
		'comments' => $faker->name,
		'receive_comments' => $faker->name
    ];
});