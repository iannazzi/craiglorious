<?php

$factory->define(App\Models\Tenant\ProductsSkus::class, function (Faker\Generator $faker) {
    return [
        'product_id' => $faker->name,
		'product_color_id' => $faker->name,
		'active' => $faker->name,
		'inventory_warning' => $faker->name,
		'product_sku' => $faker->name,
		'product_upc' => $faker->name,
		'product_subid_name' => $faker->name,
		'barcode' => $faker->name,
		'attributes_hash' => $faker->name,
		'attributes_list' => $faker->name,
		'comments' => $faker->name
    ];
});