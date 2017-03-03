<?php
use IannazziTestLibrary\Tests\ApiTester;
use App\Models\Tenant\User;

class RegisterTest extends ApiTester{


    /** @test */
    function register_system()
    {

        $this->json('POST', '/api/register', ['company' => $this->faker->company, 'name' => $this->faker->name, 'email' => $this->faker->email, 'password' => 'iluv2tow', 'password_confirmation'=>'iluv2tow'])
            ->see('token');


//        $res = $this->post('/api/register', ['company' => 'peache', 'name'=> 'JD', 'email'=> 'test@test.com']);
//        $res->seeStatusCode(200);


    }

}