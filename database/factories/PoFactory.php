<?php

$factory->define(App\Models\Tenant\Po::class, function (Faker\Generator $faker) {
    return [
        'user_id_for_entry_lock' => $faker->name,
		'manufacturer_id' => $faker->name,
		'brand_id' => $faker->name,
		'category_id' => $faker->name,
		'user_id' => $faker->name,
		'store_id' => $faker->name,
		'po_number' => $faker->name,
		'manufacturer_po_number' => $faker->name,
		'po_type' => $faker->name,
		'create_date' => $faker->name,
		'placed_date' => $faker->name,
		'status_date' => $faker->name,
		'delivery_date' => $faker->name,
		'cancel_date' => $faker->name,
		'received_date' => $faker->name,
		'receive_store_id' => $faker->name,
		'receive_user_id' => $faker->name,
		'employee_po_creater_name' => $faker->name,
		'po_status' => $faker->name,
		'ordered_status' => $faker->name,
		'received_status' => $faker->name,
		'invoice_status' => $faker->name,
		'comments' => $faker->name,
		'po_title' => $faker->name,
		'stored_size_chart' => $faker->name,
		'wrong_items_qty' => $faker->name,
		'wrong_items_comments' => $faker->name,
		'log' => $faker->name,
		'ra_required' => $faker->name,
		'ra_number' => $faker->name,
		'credit_memo_required' => $faker->name,
		'credit_memo_invoice_number' => $faker->name
    ];
});