<?php


use App\Classes\Seeder\Demo\DemoDatabaseSeeder;
use App\Models\Tenant\Employee;
use App\Models\Tenant\Location;
use App\Models\Tenant\Vendor;
use Iannazzi\Generators\DatabaseImporter\DatabaseSelector;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;

class DemoDatabaseTest extends ApiTester
{

    /** @test */
    function system_init()
    {
        $this->console('Testing Demo Database');
        // do not touch the cg database System::truncate();
        DemoDatabaseSeeder::run();
        $system = $this->getSystem('demo');
        $tables = DatabaseSelector::getTables($system->dbc());
        $this->assertNotNull($tables);
    }
    /** @test */
    function faker_data_loaded()
    {
        $system = $this->getSystem('demo');
        $this->assertNotCount(0, Employee::all());
        $this->assertNotCount(0, Vendor::all());
        $this->assertNotCount(0, Location::all());

    }
}