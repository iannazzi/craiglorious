<?php
namespace App\Classes\Registration;


use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class RegisterTenant {


    public static function register(array $data)
    {
        return System::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => 0,
            'registered' => 0
        ]);
    }
    public static function buildSystem($system)
    {
        $tenantSystemBuilder = new tenantSystemBuilder($system);
        $tenantSystemBuilder->setupTenantSystem();
        $system->active = 1;
        $system->registered = 1;
        $system->save();

    }
}