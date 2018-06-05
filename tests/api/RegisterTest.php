<?php
use Tests\ApiTester;
use App\Models\Tenant\User;

class RegisterTest extends ApiTester{
    protected $route = 'register';

    /** @test */
    function register_system()
    {
        $rawContent = '{"company":"Change me","name":"Peter","email":"Peter@changeme.com","password":"secret235","password_confirmation":"secret235"}';

        $this->json('POST', '/api/register', ['company' => $this->faker->company, 'name' => $this->faker->name, 'email' => $this->faker->email, 'password' => 'secret235', 'password_confirmation'=>'secret235'])
            ->assertJson(["success"=>'true']);


//        $res = $this->post('/api/register', ['company' => 'peache', 'name'=> 'JD', 'email'=> 'test@test.com']);
//        $res->seeStatusCode(200);


    }

}