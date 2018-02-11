<?php


use App\Classes\Seeder\Demo\DemoDatabaseSeeder;
use App\Models\Tenant\Employee;
use App\Models\Tenant\Location;
use App\Models\Tenant\Vendor;
use Iannazzi\Generators\DatabaseImporter\DatabaseSelector;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;

class ProductionDatabaseTest extends ApiTester
{

    /** @test */
    function migrate_production()
    {
        Artisan::call('zz:MigrateProduction');
    }

}