<?php

$factory->define(App\Models\Tenant\Document::class, function (Faker\Generator $faker) {
    return [
        'user_id_for_entry_lock' => $faker->name,
		'document_name' => $faker->name,
		'document_date' => $faker->name,
		'user_id' => $faker->name,
		'document_text' => $faker->name,
		'auto_save_document_text' => $faker->name,
		'comments' => $faker->name,
		'document_overview' => $faker->name
    ];
});