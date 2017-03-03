<?php
use App\Models\Tenant\User;
use IannazziTestLibrary\Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends ApiTester
{
    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(User::all());
    }
    /** @test */
    function index()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $this->get('/users')
        ->assertResponseOk();
    }
    /** @test */
    function can_be_searched()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();

        $rawContent = '{"search_fields":{"user_table_id":"5","user_table_role_id":"null","user_table_username":"","user_table_active":"null"},"table_name":"user_table"}';

        $this->json('POST', '/users/search', json_decode($rawContent, true))
            ->see('"success":true');


    }

    /** @test */
    function can_be_created()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();
        $username = $this->faker->userName.$this->fake->firstName;


        $password = createPassword();

        $rawContent = '{"data":[{"id":"","role_id":"4","username":"' . $username . '","password":"' . $password . '","password_confirmation":"' . $password . '","passcode":"","passcode_confirmation":"","employee_id":"null","active":1}],"_method":"put"}';

        $this->json('put', '/users', json_decode($rawContent, true))
            ->see('"success":true');

    }

    /** @test */
    function password_can_be_updated()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();
        $username = $this->faker->userName;
        $password = createPassword();

        $rawContent = '{"password":"*_Erica_1964","password_confirmation":"*_Erica_1964"}
';

        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":true');

    }
    /** @test */
    function bad_password()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();
        $username = $this->faker->userName;
        $password = createPassword();

        $rawContent = '{"password":"1234","password_confirmation":"1234"}
';

        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":false');

    }
    /** @test */
    function passcode_can_be_updated()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();
        $rawContent = '{"passcode":"11111","passcode_confirmation":"11111"}';

        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":true');

    }
    /** @test */
    function bad_passcode()
    {
        $system = $this->getSystem();
        $user = User::find(1);
        $this->be($user);
        $this->withoutMiddleware();
        $rawContent = '{"passcode":"1234","passcode_confirmation":"1234"}

';

        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":false');

    }

    /** @test */

    function duplicate_passcode(){
        $system = $this->getSystem();

        $user = User::find(2);
        $this->be($user);
        $this->withoutMiddleware();
        $rawContent = '{"passcode":"01111","passcode_confirmation":"01111"}';
        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":true');

        $user = User::find(3);
        $this->be($user);
        $rawContent = '{"passcode":"01111","passcode_confirmation":"01111"}';
        $this->json('post', '/user', json_decode($rawContent, true))
            ->see('"success":false');

    }



    /** @test */
//    function can_be_updated()
//    {
//        $system = $this->getSystem();
//        $user = User::find(1);
//        $this->be($user);
//        $this->withoutMiddleware();
//
//        $rawContent = '{"search_fields":{"user_table_id":"5","user_table_role_id":"null","user_table_username":"","user_table_active":"null"},"table_name":"user_table"}';
//
//        $this->json('put', '/users', json_decode($rawContent, true))
//            ->see('"success":true');
//
//    }
//    /** @test */
//    function can_be_destroyed()
//    {
//        $system = $this->getSystem();
//        $user = User::find(1);
//        $this->be($user);
//        $this->withoutMiddleware();
//        $rawContent = '{"_method":"delete","data":{"id":7}}';
//        $this->json('delete', '/users', json_decode($rawContent, true))
//            ->see('"success":true');
//    }

}