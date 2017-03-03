<?php

$factory->define(App\Models\Tenant\DocumentsBackup::class, function (Faker\Generator $faker) {
    return [
        'document_id' => $faker->name,
		'document_name' => $faker->name,
		'document_date' => $faker->name,
		'user_id' => $faker->name,
		'document_text' => $faker->name,
		'comments' => $faker->name,
		'document_overview' => $faker->name
    ];
});