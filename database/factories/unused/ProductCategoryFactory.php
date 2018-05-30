<?php

$factory->define(App\Models\Tenant\ProductCategory::class, function (Faker\Generator $faker) {
    return [
        'parent' => $faker->name,
		'level' => $faker->name,
		'priority' => $faker->name,
		'default_product_priority' => $faker->name,
		'sales_tax_category_id' => $faker->name,
		'is_visible' => $faker->name,
		'list_subcats' => $faker->name,
		'url_hash' => $faker->name,
		'url_default' => $faker->name,
		'url_custom' => $faker->name,
		'key_name' => $faker->name,
		'category_header' => $faker->name,
		'meta_keywords' => $faker->name,
		'meta_title' => $faker->name,
		'meta_description' => $faker->name,
		'name' => $faker->name,
		'description' => $faker->name,
		'description_bottom' => $faker->name,
		'category_path' => $faker->name,
		'active' => $faker->name
    ];
});