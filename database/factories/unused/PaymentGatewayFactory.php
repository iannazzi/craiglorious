<?php

$factory->define(App\Models\Tenant\PaymentGateway::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->name,
		'store_id' => $faker->name,
		'account_id' => $faker->name,
		'login_id' => $faker->name,
		'transaction_key' => $faker->name,
		'gateway_provider' => $faker->name,
		'model_name' => $faker->name,
		'website_url' => $faker->name,
		'user_name' => $faker->name,
		'password' => $faker->name,
		'line' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});