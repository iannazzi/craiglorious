<?php

$factory->define(App\Models\Tenant\Roles::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->name,
		'name' => $faker->name,
		'allow_edit_invoice_details' => $faker->name,
		'allow_voids' => $faker->name,
		'allow_refunds' => $faker->name,
		'max_discount_percent' => $faker->name,
		'edit_closed_contents' => $faker->name,
		'edit_closed_payments' => $faker->name,
		'edit_closed_customer' => $faker->name,
		'allow_other_payment' => $faker->name,
		'allow_cc_return' => $faker->name,
		'allow_advanced_return' => $faker->name,
		'open_close_terminal' => $faker->name,
		'po_max_open_past_cancel' => $faker->name,
		'po_max_received_not_invoiced' => $faker->name,
		'active' => $faker->name,
		'comments' => $faker->name
    ];
});