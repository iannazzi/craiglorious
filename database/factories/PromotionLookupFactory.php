<?php

$factory->define(App\Models\Tenant\PromotionLookup::class, function (Faker\Generator $faker) {
    return [
        'promotion_id' => $faker->name,
		'product_id' => $faker->name,
		'product_category_id' => $faker->name,
		'include_subcategories' => $faker->name,
		'brand_id' => $faker->name,
		'include_product' => $faker->name,
		'include_brand' => $faker->name,
		'include_category' => $faker->name
    ];
});