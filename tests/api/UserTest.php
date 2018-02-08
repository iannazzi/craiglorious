<?php
use App\Models\Tenant\User;
use Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends ApiTester
{
    protected $route = 'users';

    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }

    /** @test */
    function can_be_searched()
    {
        $rawContent = '{"search_fields":{"user_table_id":"5","user_table_role_id":"null","user_table_username":"","user_table_active":"null"},"table_name":"user_table"}';

        $this->searchSuccess($this->route, $rawContent);
    }

    /** @test */
    function get_create()
    {
        $this->signIn();
        $rawContent='{}';
        $this->json('GET', $this->api($this->route .'/create'), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);


    }

    /** @test */
    function can_be_created()
    {

        $username = $this->faker->userName . $this->fake->firstName;
        $password = createPassword();

        $rawContent = '{"data":[{"id":"","role_id":"4","username":"' . $username . '","password":"' . $password . '","password_confirmation":"' . $password . '","active":1}],"_method":"put"}';

        $this->createSuccess($this->route, $rawContent);


    }

    /** @test */
    function password_can_be_updated()
    {
//        $this->signIn();
//
//        $username = $this->faker->userName;
//        $password = createPassword();
//
//        $rawContent = '{"password":"*_Erica_1964","password_confirmation":"*_Erica_1964"}
//';
//
//        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
//            ->assertJson(["success" => 'true']);


    }

    /** @test */
    function bad_password()
    {
        $this->signIn();

        $username = $this->faker->userName;
        $password = createPassword();

        $rawContent = '{"password":"1234","password_confirmation":"1234"}
';

        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
            ->assertJson(["success" => false]);


    }

    /** @test */
    function passcode_can_be_updated()
    {
        $this->signIn();

        $rawContent = '{"passcode":"11111","passcode_confirmation":"11111"}';

        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
            ->assertJson(["success" => 'true']);


    }

    /** @test */
    function bad_passcode()
    {
        $this->signIn();
        $rawContent = '{"passcode":"1234","passcode_confirmation":"1234"}

';

        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
            ->assertJson(["success" => false]);


    }

    /** @test */
    function duplicate_passcode()
    {
        $this->signIn();

        $rawContent = '{"passcode":"01111","passcode_confirmation":"01111"}';
        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
            ->assertJson(["success" => true]);

        $this->signIn('demo', 'owner', 'secret');
        $rawContent = '{"passcode":"01111","passcode_confirmation":"01111"}';
        $this->json('post', '/api/user', json_decode($rawContent, true), $this->headers())
            ->assertJson(["success" => false]);


    }


}