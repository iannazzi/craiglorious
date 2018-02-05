<?php


use App\Models\Tenant\Employee;
use App\Models\Tenant\User;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class emDatabaseTest extends ApiTester
{

    /** @test */
    function em_seeder()
    {
        dd(env('APP_ENV'));
        Artisan::call('db:seed', [
            '--class' => "EmbrasseMoiDatabaseSeeder",
        ]);
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