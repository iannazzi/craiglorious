<?php


use App\Models\Tenant\Employee;
use App\Models\Tenant\User;
use App\Models\Tenant\Role;

use App\Models\Tenant\Vendor;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;
use Iannazzi\Generators\DatabaseImporter\DatabaseSelector;


class NewCompanyDatabaseTest extends ApiTester
{
    /** @test */
    function new_company_test()
    {
        $this->console('Creating test company');
        $system = System::where('company','test')->firstOrFail();
        $tenantSystemBuilder = new TenantSystemBuilder($system);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $tables = DatabaseSelector::getTables($system->dbc());
        $this->assertNotNull($tables);
        $this->assertCount(0, Employee::all());
        $this->assertCount(0, Vendor::all());
        $this->assertEquals('admin',User::first()->username);
    }
    /** @test */
    function initialized_data_loaded()
    {
        $system = $this->getSystem('test');
        $this->assertNotNull(Role::all());
        $this->assertNotNull(User::all());

    }

}