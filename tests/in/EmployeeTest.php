<?php
use App\Models\Tenant\Employee;
use Tests\ApiTester;
use App\Models\Tenant\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;


class EmployeeTest extends ApiTester
{
    protected $route = 'employees';



    /** @test */
    function factory()
    {
        $system = $this->getSystem();
        $fac = Factory('App\Models\Tenant\Employee', 30)->create();
        $this->assertNotNull($fac);
    }
    /** @test */
    function seed()
    {
        $system = $this->getSystem();
        \DB::table('employees')->truncate();
        Artisan::call('db:seed', [
            '--class' => "EmployeesTableSeeder",
        ]);
    }




    /** @test */
    function loaded()
    {
        $system = $this->getSystem();

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
        $rawContent = '{"search_fields":{"employees_full_name":"a","employees_comments":"","employees_active":"null"},"table_name":"employees"}';
        $this->searchSuccess($this->route, $rawContent);

    }
//    /** @test */
//    function can_be_created()
//    {
//        $rawContent = '{"data":[{"id":"","name":"'. $this->faker->name . '","coa_number":"13388","type":"Expense","parent_id":"","active":1,"comments":""}],"_method":"put"}';
//
//
//        $this->createSuccess($this->route, $rawContent);
//    }
//    /** @test */
//    function can_be_shown()
//    {
//        $system = $this->getSystem();
//        $id = Account::first()->id;
//        $this->showSuccess($this->route, $id);
//
//    }
//    /** @test */
//    function can_be_updated()
//    {
//
//        $rawContent = '{"data":[{"id":"6","name":"'. $this->faker->name . '","coa_number":"13388","type":"Expense","parent_id":"","active":1,"comments":""}],"_method":"put"}';
//        $this->updateSuccess($this->route, $rawContent);
//
//    }
//    /** @test */
//    function can_not_delete_required_account()
//    {
//        $rawContent = '{"_method":"delete","data":{"id":1}}';
//        $this->deleteSuccess($this->route, $rawContent, false);
//
//
//    }
//    /** @test */
//    function can_be_destroyed()
//    {
//        $rawContent = '{"_method":"delete","data":{"id":45}}';
//        $this->deleteSuccess($this->route, $rawContent);
//
//
//    }
}