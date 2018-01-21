<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\AccountType;

class Employee extends BaseTenantModel {


    protected $guarded = ['id'];
//    protected $casts = [
//        'active' => 'boolean',
//    ];

    function scopeWithName($query, $name)
    {
        // Split each Name by Spaces
        $names = explode(" ", $name);

        // Search each Name Field for any specified Name
        return User::where(function($query) use ($names) {
            $query->whereIn('first_name', $names);
            $query->orWhere(function($query) use ($names) {
                $query->whereIn('last_name', $names);
            });
        });
    }

}