<?php

$factory->define(App\Models\Tenant\BrandSize::class, function (Faker\Generator $faker) {
    return [
        'brand_id' => $faker->name,
		'category_id' => $faker->name,
		'product_attribute_id' => $faker->name,
		'case_qty' => $faker->name,
		'cup' => $faker->name,
		'cup_required' => $faker->name,
		'inseam' => $faker->name,
		'width' => $faker->name,
		'size_modifier' => $faker->name,
		'sizes' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});