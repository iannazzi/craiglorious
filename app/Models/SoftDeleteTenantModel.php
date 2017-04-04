<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeleteTenantModel extends BaseTenantModel {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}