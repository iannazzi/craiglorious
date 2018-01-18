<?php
use Tests\ApiTester;
use App\Models\Tenant\User;

class RegisterTest extends ApiTester{


    /** @test */
    function register_system()
    {
        $rawContent = '{"search_fields":{"vendor_table_id":"123","vendor_table_name":"","vendor_table_account_number":"","vendor_table_active":"null"},"table_name":"vendor_table"}';

        $this->searchSuccess($this->route, $rawContent);

        $this->json('POST', '/api/register', ['company' => $this->faker->company, 'name' => $this->faker->name, 'email' => $this->faker->email, 'password' => 'iluv2tow', 'password_confirmation'=>'iluv2tow'])
            ->see('token');


//        $res = $this->post('/api/register', ['company' => 'peache', 'name'=> 'JD', 'email'=> 'test@test.com']);
//        $res->seeStatusCode(200);


    }

}