<?php
use App\Models\Tenant\Employee;
use Tests\ApiTester;
use App\Models\Tenant\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;


class EmployeeTest extends ApiTester
{
    protected $route = 'employees';


    /** @test */
    function em_has_employees()
    {
        Artisan::call('db:seed', [
            '--class' => "EmbrasseMoiDatabaseSeeder",
        ]);
        $system = $this->getSystem('embrasse-moi');
        $this->assertNotCount(0, Employee::all());

    }
    /** @test */
    function factory()
    {
        $system = $this->getSystem();
        $fac = Factory('App\Models\Tenant\Employee', 30)->create();
        $this->assertNotNull($fac);
    }

    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        \DB::table('employees')->truncate();
        Artisan::call('db:seed', [
            '--class' => "EmployeesTableSeeder",
        ]);
        $emp = Employee::all();
//        dd($emp[3]);
//        var_dump($emp);
        $this->assertNotNull($emp);

    }
    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"employees_first_name":"","employees_last_name":"","employees_comments":"","employees_active":"1"},"table_name":"employees"}';
        $this->searchSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_created()
    {
        $rawContent = '{"data":[{"id":"","first_name":"'. $this->faker->name . '","last_name":"'. $this->faker->name . '","active":1,"comments":""}],"_method":"put"}';


        $this->createSuccess($this->route, $rawContent);
    }
    /** @test */
    function can_be_shown()
    {
        $system = $this->getSystem();
        $id =Employee::first()->id;
        $this->showSuccess($this->route, $id);

    }
    /** @test */
    function can_be_updated()
    {

        $rawContent = '{"data":[{"id":19,"first_name":"Delaney","last_name":"Koch","phone":"885-349-9918 x7584","email":"delfina.gutmann@gmail.com","address1":"1140 McClure Mission","address2":"Apt. 425","address3":"","city":"Juanitaville","state_id":"4","zip":"98063","emergency_contact":"Charity Roob V","emergency_phone":"305-648-1980 x41695","ss":"888-14-2838","withholding_allowance":"","comments":"","active":0}],"_method":"put"}';
        $this->updateSuccess($this->route, $rawContent);

    }
    /** @test */
    function ss_unique()
    {

        $rawContent = '{"data":[{"id":"2","first_name":"'. $this->faker->name . '","last_name":"'. $this->faker->name . '","active":1,"comments":"", "ss":"111-11-1111"}],"_method":"put"}';
        $this->updateSuccess($this->route, $rawContent);
        $rawContent = '{"data":[{"id":"3","first_name":"'. $this->faker->name . '","last_name":"'. $this->faker->name . '","active":1,"comments":"", "ss":"111-11-1111"}],"_method":"put"}';
        $this->updateSuccess($this->route, $rawContent, false);


    }


    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"_method":"delete","data":{"id":4}}';
        $this->deleteSuccess($this->route, $rawContent);


    }
}