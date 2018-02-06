<?php


use App\Classes\Seeder\EmbrasseMoi\EmbrasseMoiDatabaseSeeder;
use App\Models\Tenant\Employee;
use App\Models\Tenant\User;
use Iannazzi\Generators\DatabaseImporter\DatabaseSelector;
use Tests\ApiTester;

class EmbrasseMoiDatabaseTest extends ApiTester
{

    /** @test */
    function em_seeder()
    {
        $this->console('Testing Embrasse-Moi Database');
        EmbrasseMoiDatabaseSeeder::run();
        $system = $this->getSystem('Embrasse-Moi');
        $tables = DatabaseSelector::getTables($system->dbc());
        $this->assertNotNull($tables);
    }
    /** @test */
    function employees_are_loaded()
    {
        $system = $this->getSystem('Embrasse-moi');
        $this->assertNotCount(0, Employee::all());
    }
    /** @test */
    function users_are_loaded()
    {
        $system = $this->getSystem('Embrasse-moi');
        $user = User::first();
        $this->assertEquals($user->username, 'craig.iannazzi');
    }

}