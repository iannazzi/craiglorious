<?php

$factory->define(App\Models\Tenant\PromotionBuy::class, function (Faker\Generator $faker) {
    return [
        'promotion_id' => $faker->name,
		'buy' => $faker->name,
		'get' => $faker->name,
		'discount' => $faker->name,
		'd_or_p' => $faker->name
    ];
});