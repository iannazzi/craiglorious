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
    function sign_in()
    {
        $this->signIn('embrasse-moi','craig.iannazzi', 'feeling positive');
    }
    /** @test */
    function employees_index()
    {
        $this->indexSuccess('employees', 'embrasse-moi','craig.iannazzi', 'feeling positive');
    }

    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"employees_first_name":"","employees_last_name":"","employees_comments":"","employees_active":"1"},"table_name":"employees"}';
        $this->searchSuccess('employees', $rawContent);
    }
    /** @test */
    function users_are_loaded()
    {
        $system = $this->getSystem('Embrasse-moi');
        $emp = Employee::where('first_name','craig')->first();
        $this->assertEquals($emp->user()->username, 'craig.iannazzi');
    }
    /** @test */
    function employee_has_a_user()
    {
        $system = $this->getSystem('Embrasse-moi');
        $user = User::first();
        $this->assertEquals($user->username, 'craig.iannazzi');
    }

}