<?php


use App\Classes\File\CIFile;
use App\Classes\Seeder\EmbrasseMoi\EmbrasseMoiDatabaseSeeder;
use App\Models\Tenant\Employee;
use App\Models\Tenant\User;
use Iannazzi\Generators\DatabaseImporter\DatabaseSelector;
use Tests\ApiTester;

class EmbrasseMoiDatabaseTest extends ApiTester
{
    protected $users;


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
    function user_password()
    {
        $this->assertNotEmpty($this->password('craig.iannazzi'));
        $this->assertFalse($this->password('fox.mulder'));
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
        $this->signIn('embrasse-moi','craig.iannazzi', $this->password('craig.iannazzi'));
    }
    /** @test */
    function employees_index()
    {
        $this->indexSuccess('employees', 'embrasse-moi','craig.iannazzi', $this->password('craig.iannazzi'));
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

    function password($username){
        $cifile = new CIFile();
        $filename = em_data_seed_path() . '/users.csv';
        $users = $cifile->csvToArray($filename, ';');
        foreach ($users as $user){
            if($user['username'] == $username){
                return $user['password'];
            }
        }
        return false;
    }
}