<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index();
            $table->string('name', 40);
            $table->text('ip_address_restrictions')->nullable();
            $table->boolean('relogin_on_ip_address_change');
            $table->boolean('restrict_to_terminal_access');
            $table->integer('timeout_minutes');
            $table->boolean('allow_edit_invoice_details');
            $table->boolean('allow_edit_closed_invoice');
            $table->boolean('allow_voids');
            $table->boolean('allow_refunds');
            $table->decimal('max_discount_percent', 20, 5);
            $table->boolean('edit_closed_contents');
            $table->boolean('edit_closed_payments');
            $table->boolean('edit_closed_customer');
            $table->boolean('allow_other_payment');
            $table->boolean('allow_cc_return');
            $table->boolean('allow_advanced_return');
            $table->boolean('open_close_terminal');
            $table->integer('po_max_open_past_cancel');
            $table->integer('po_max_received_not_invoiced');
            $table->boolean('active');
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
