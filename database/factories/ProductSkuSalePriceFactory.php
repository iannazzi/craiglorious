<?php

$factory->define(App\Models\Tenant\ProductSkuSalePrice::class, function (Faker\Generator $faker) {
    return [
        'product_sku_id' => $faker->name,
		'sale_barcode' => $faker->name,
		'price_level' => $faker->name,
		'price' => $faker->name,
		'title' => $faker->name,
		'as_is' => $faker->name,
		'clearance' => $faker->name,
		'comments' => $faker->name
    ];
});