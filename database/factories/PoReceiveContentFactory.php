<?php

$factory->define(App\Models\Tenant\PoReceiveContent::class, function (Faker\Generator $faker) {
    return [
        'po_receive_event_id' => $faker->name,
		'po_content_id' => $faker->name,
		'received_quantity' => $faker->name,
		'receive_comments' => $faker->name
    ];
});