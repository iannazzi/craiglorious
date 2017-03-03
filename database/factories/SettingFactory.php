<?php

$factory->define(App\Models\Tenant\Setting::class, function (Faker\Generator $faker) {
    return [
        'visible' => $faker->name,
		'input_type' => $faker->name,
		'group_name' => $faker->name,
		'priority' => $faker->name,
		'name' => $faker->name,
		'value' => $faker->name,
		'value_text' => $faker->name,
		'options' => $faker->name,
		'default_value' => $faker->name,
		'validation' => $faker->name,
		'caption' => $faker->name,
		'description' => $faker->name
    ];
});